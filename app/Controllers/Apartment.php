<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApartmentModel;
use App\Models\TenantModel;
use App\Models\BillModel;
use App\Models\PaymentModeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Apartment extends BaseController
{
    protected $apartmentModel;
    protected $tenantModel;
    protected $billModel;
    protected $paymentModeModel;



    public function __construct()
    {
        $this->apartmentModel = new ApartmentModel();
        $this->tenantModel = new TenantModel();
        $this->billModel = new BillModel();
        $this->paymentModeModel = new PaymentModeModel();
    }
    public function index()
    {
        $data['apartments'] = $this->apartmentModel->findAll();
        return view('apartment/index', $data);
    }
    public function add()
    {
        return view('apartment/add');
    }

    public function create()
    {
        // Validate input data
        if (!$this->validate([
            'apartment_no' => 'required|is_unique[apartments.apartment_no]',
            'owner_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'block' => 'required',
            'type' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the apartment
        $apartmentData = [
            'apartment_no' => $this->request->getPost('apartment_no'),
            'owner_name' => $this->request->getPost('owner_name'),
            'address' => $this->request->getPost('address'),
            'contact_no' => $this->request->getPost('contact_no'),
            'block' => $this->request->getPost('block'),
            'type' => $this->request->getPost('type'),
            'occupancy' => 'Vacant',
            'created_by' => $this->session->get('user_id'), // Assuming user_id is in session
            'updated_by' => $this->session->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->apartmentModel->save($apartmentData);
        return redirect()->to('/apartment');
    }

    public function edit($id)
    {
        $data['apartment'] = $this->apartmentModel->find($id);
        return view('apartment/edit', $data);
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

        $this->apartmentModel->update($id, $apartmentData);
        return redirect()->to('/apartment');
    }
    public function delete($id)
    {
        // Delete the apartment
        $this->apartmentModel->delete($id);
        // Redirect back to the apartment list
        return redirect()->to('/apartment');
    }
    public function view($id)
    {
        $apartmentModel = new ApartmentModel();
        // $tenantModel = new TenantModel();
        // $billModel = new BillModel();
        // $paymentModel = new PaymentModel();

        $apartment = $apartmentModel->find($id);
        if (!$apartment) {
            return redirect()->to('/apartment')->with('status', 'danger')->with('message', 'Apartment not found.');
        }

        $data = [
            'apartment' => $apartment,
            // 'tenants' => $tenantModel->where('apartment_id', $id)->findAll(),
            // 'bills' => $billModel->where('apartment_id', $id)->findAll(),
            // 'payments' => $paymentModel->where('apartment_id', $id)->findAll(),
        ];

        return view('apartment/apartment_tab', $data);
    }
    public function apartmentDetails($apartmentId)
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
                $payment_modes = $this->paymentModeModel->where('is_active', true)->findAll();
                break;
            case 'payments':
                $tabView = 'apartment/payments';
                break;
            case 'advance':
                $tabView = 'bills/advance';
                break;
            case 'apartment':
            default:
                $tabView = 'apartment/apartment_details';
                break;
        }

        $apartment = $this->apartmentModel->find($apartmentId);

        return view('apartment/apartment_tab', [
            'apartment' => $apartment,
            'activeTab' => $tab,
            'tabView' => $tabView,
            'tenants' => $tenants,
            'bills' => $bills,
            'payment_modes' => $payment_modes,
        ]);
    }
}
