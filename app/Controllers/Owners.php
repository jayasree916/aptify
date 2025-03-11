<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApartmentModel;
use App\Models\OwnerModel;
use App\Models\TenantModel;
use App\Models\BillModel;
use App\Models\PaymentModeModel;
use App\Models\BillItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class Owners extends BaseController
{
    protected $apartmentModel;
    protected $ownerModel;
    protected $tenantModel;
    protected $billModel;
    protected $paymentModeModel;
    protected $billItemModel;
    
    public function __construct()
    {
        $this->apartmentModel = new ApartmentModel();
        $this->ownerModel = new OwnerModel();
        $this->tenantModel = new TenantModel();
        $this->billModel = new BillModel();
        $this->paymentModeModel = new PaymentModeModel();
        $this->billItemModel = new BillItemModel();
    }
    public function index()
    {
        $data['owners'] = $this->ownerModel->select('owners.*, apartments.name AS apartment_no')
                    ->join('apartments', 'apartments.id = owners.apartment_id', 'left')
                    ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('owners/index', $data);
    }
    public function add()
    {
        $data['apartments'] = $this->apartmentModel->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('owners/add', $data);
    }

    public function create()
    {
        // Validate input data
        if (!$this->validate([
            'apartment_no' => 'required',
            'owner_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'from_date' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if there is an existing owner with to_date NULL or in the future
    $existingOwner = $this->ownerModel
    ->where('apartment_id', $this->request->getPost('apartment_no'))
    ->where('(to_date IS NULL OR to_date > NOW())', null, false)
    ->first();

if ($existingOwner) {
    return redirect()->back()->withInput()->with('error', 'Cannot add a new owner. Previous owner is active now');
} else {

        // Save the apartment
        $apartmentData = [
            'apartment_id' => $this->request->getPost('apartment_no'),
            'owner_name' => $this->request->getPost('owner_name'),
            'address' => $this->request->getPost('address'),
            'mobile_no' => $this->request->getPost('contact_no'),
            'email' => $this->request->getPost('email'),
            'from_date' => $this->request->getPost('from_date'),
            'created_by' => $this->session->get('user_id'), // Assuming user_id is in session
            'updated_by' => $this->session->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->ownerModel->save($apartmentData);
        return redirect()->to('/owners');
    }
    }

    public function edit($id)
    {
        $data['owner'] = $this->ownerModel->find($id);
        $data['menuItems'] = $this->menuItems;
        return view('owners/edit', $data);
    }

    public function update($id)
    {
        // Validate input data
        if (!$this->validate([
            'apartment_no' => 'required',
            'owner_name' => 'required',
            'address' => 'required',
            'block' => 'required',
            'type' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update the apartment
        $apartmentData = [
            'apartment_no' => $this->request->getPost('apartment_no'),
            'owner_name' => $this->request->getPost('owner_name'),
            'address' => $this->request->getPost('address'),
            'contact_no' => $this->request->getPost('contact_no'),
            'block' => $this->request->getPost('block'),
            'type' => $this->request->getPost('type'),
            // 'occupancy' => $this->request->getPost('occupancy'),
            'updated_by' => $this->session->get('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->ownerModel->update($id, $apartmentData);
        return redirect()->to('/owners');
    }
    public function delete($id)
    {
        // Delete the apartment
        $this->ownerModel->delete($id);
        // Redirect back to the apartment list
        return redirect()->to('/owners');
    }
    public function view($id)
    {
        $apartmentModel = new ApartmentModel();
        // $tenantModel = new TenantModel();
        // $billModel = new BillModel();
        // $paymentModel = new PaymentModel();

        $apartment = $apartmentModel->find($id);
        if (!$apartment) {
            return redirect()->to('/owners')->with('status', 'danger')->with('message', 'Apartment not found.');
        }

        $data = [
            'apartment' => $apartment,
            // 'tenants' => $tenantModel->where('apartment_id', $id)->findAll(),
            // 'bills' => $billModel->where('apartment_id', $id)->findAll(),
            // 'payments' => $paymentModel->where('apartment_id', $id)->findAll(),
        ];
        $data['menuItems'] = $this->menuItems;

        return view('owners/apartment_tab', $data);
    }
    public function ownerDetails($apartmentId)
    {
        $tab = $this->request->getGet('tab') ?? 'apartment';
        $tabView = '';
        $tenants = '';
        $bills = '';
        $payment_modes = '';

        // Select the appropriate view for the tab
        switch ($tab) {
            case 'tenants':
                $tabView = 'tenants/tenant_view';
                $tenants = $this->tenantModel->where('apartment_id', $apartmentId)->findAll();
                break;
            case 'bills':
                $tabView = 'bills/bill_view';
                $bills = $this->billModel->where('apartment_id', $apartmentId)->where('paid', '0')->findAll();
                $i=0;
                foreach ($bills as $bill) {
                    $items = $this->billItemModel->where('bill_id', $bill['id'])->findAll();
                    $bills[$i]['items'] = $items;
                    $i++;
                }
                $payment_modes = $this->paymentModeModel->where('is_active', true)->findAll();
                break;
            case 'payments':
                $tabView = 'bills/receipts';
                $bills = $this->billModel->where('apartment_id', $apartmentId)->where('paid', '1')->findAll();
                $i = 0;
                foreach ($bills as $bill) {
                    $items = $this->billItemModel->where('bill_id', $bill['id'])->findAll();
                    $bills[$i]['items'] = $items;
                    $i++;
                }
                $payment_modes = $this->paymentModeModel->where('is_active', true)->findAll();
                break;
            case 'advance':
                $tabView = 'bills/advance';
                $payment_modes = $this->paymentModeModel->where('is_active', true)->findAll();
                break;
            case 'owners':
            default:
                $tabView = 'owners/apartment_details';
                break;
        }

        $apartment = $this->ownerModel->select('owners.*, apartments.name AS apartment_no, blocks.name AS block')
        ->join('apartments', 'apartments.id = owners.apartment_id', 'left')
        ->join('blocks', 'blocks.id = apartments.block_id', 'left')
        ->where('owners.apartment_id', $apartmentId)
        ->where('(owners.to_date IS NULL OR owners.to_date >= CURDATE())')
        ->first();

        return view('owners/apartment_tab', [
            'apartment' => $apartment,
            'activeTab' => $tab,
            'tabView' => $tabView,
            'tenants' => $tenants,
            'bills' => $bills,
            'payment_modes' => $payment_modes,
            'menuItems'=> $this->menuItems,
        ]);
    }
}
