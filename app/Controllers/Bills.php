<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillModel;
use App\Models\BillItemModel;
use App\Models\ApartmentModel;
use App\Models\BillingTypeModel;
use App\Models\TenantModel;
use CodeIgniter\HTTP\ResponseInterface;

class Bills extends BaseController
{
    protected $billModel;
    protected $billItemModel;
    protected $apartmentModel;
    protected $tenantModel;
    protected $billingTypeModel;

    public function __construct()
    {
        $this->billModel = new BillModel();
        $this->billItemModel = new BillItemModel();
        $this->apartmentModel = new ApartmentModel();
        $this->tenantModel = new TenantModel();
        $this->billingTypeModel = new BillingTypeModel();
    }

    public function index()
    {
        $bills = $this->billModel
        ->select('bills.*, apartments.owner_name AS owner_name, tenants.tenant_name AS tenant_name')
        ->join('apartments', 'apartments.id = bills.apartment_id') // Adjust the foreign key relationship
        ->join('tenants','tenants.id = bills.tenant_id', 'left') // Adjust the foreign key relationship
        ->findAll();
        $data['bills'] = $bills;
        $data['menuItems'] = $this->menuItems;
        return view('bills/index', $data);
    }

    public function add()
    {
        $apartments = $this->apartmentModel->findAll();
        $billingTypes = $this->billingTypeModel->findAll();

        return view('bills/add', [
            'apartments' => $apartments,
            'billingTypes' => $billingTypes,
            'menuItems' => $this->menuItems,
        ]);
    }
    public function generateMonthlyBills()
    {
        $year = $this->request->getPost('year');
        $month = $this->request->getPost('month');
        $selectedBillingTypes = $this->request->getPost('billing_types'); // Array of selected billing type IDs

        if (!$year || !$month || empty($selectedBillingTypes)) {
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'Year, Month, and Billing Types are required.');
            return redirect()->to('/billing');
        }

        // Check for existing bills
        $existingBills = $this->billModel->where('year', $year)
            ->where('month', $month)
            ->countAllResults();

        if ($existingBills > 0) {
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'Bills for this month already exist.');
            return redirect()->to('/billing');
        }

        // Fetch apartments and selected billing types
        $apartments = $this->apartmentModel->findAll();
        $billingTypes = $this->billingTypeModel->whereIn('id', $selectedBillingTypes)->findAll();

        if (empty($apartments) || empty($billingTypes)) {
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'No apartments or billing types found.');
            return redirect()->to('/billing');
        }

        // Start database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($apartments as $apartment) {
            $tenantId = null;
            // Fetch tenant based on from_date, to_date, and billing period
            $tenant = $this->tenantModel->where('apartment_id', $apartment['id'])
            ->groupStart()
                ->where('to_date IS NULL') // Active tenant
                ->orWhere('to_date', '0000-00-00')
                ->orGroupStart()
                ->where('DATE_FORMAT(from_date, "%Y-%m") <=', "$year-$month")
                ->where('DATE_FORMAT(to_date, "%Y-%m") >=', "$year-$month")
                ->groupEnd()
                ->groupEnd()
                ->first();

            if ($tenant) {
                $tenantId = $tenant['id']; // Assign tenant ID if valid
            }

            // Generate a unique bill number
            $project_id = '1';
            $billNumber = 'BILL-' . $project_id. '/' . $apartment['id'] . '/'.$year . '/' . $month;

            // Insert into bills table
            $billData = [
                'apartment_id' => $apartment['id'],
                'tenant_id'    => $tenantId,
                'year'         => $year,
                'month'        => $month,
                'bill_no'      => $billNumber,
                'amount'       => 0, // Will be updated later
                'issued_date'  => date('Y-m-d'),
                'due_date'     => date('Y-m-d', strtotime('+15 days')),
                'generated_by' => session()->get('user_id'), // Assuming logged-in user ID is stored in session
                'generated_at' => date('Y-m-d H:i:s'),
            ];
            $billId = $this->billModel->insert($billData);

            $totalAmount = 0;

            // Insert selected bill items
            foreach ($billingTypes as $billingType) {
                $billItemData = [
                    'bill_id'      => $billId,
                    'bill_type_id' => $billingType['id'],
                    'item_name'    => $billingType['billing_type'],
                    'amount'       => $billingType['default_charge'],
                ];
                $this->billItemModel->insert($billItemData);

                $totalAmount += $billingType['default_charge'];
            }

            // Update total amount in bills table
            $this->billModel->update($billId, ['amount' => $totalAmount]);
        }

        // Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'Error occurred while generating bills.');
            return redirect()->to('/billing');
        }

        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'Monthly bills generated successfully.');
        return redirect()->to('/billing');
    }
    public function delete($id)
    {
        // Start database transaction
        $db = \Config\Database::connect();
        $db->transStart();
        // Delete related entries from the bill_items table
        $this->billItemModel->where('bill_id', $id)->delete();
        // Delete the bill from the bills table
        $this->billModel->delete($id);

        // Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {
            // Handle deletion failure
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'Failed to delete the bill.');
            return redirect()->to('/billing');
        }
        // Success message
        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'Bill deleted successfully.');
        return redirect()->to('/billing');
    }
}
