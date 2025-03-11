<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TenantModel;
use App\Models\ApartmentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tenants extends BaseController
{
    protected $tenantModel;
    protected $apartmentModel;

    public function __construct()
    {
        // Load the models
        $this->tenantModel = new TenantModel();
        $this->apartmentModel = new ApartmentModel();
    }
    public function index()
    {
        $tenants = $this->tenantModel
        ->select('tenants.*, apartments.name AS apartment_no, blocks.name AS block')
        ->join('apartments', 'tenants.apartment_id = apartments.id')
        ->join('blocks', 'apartments.block_id = blocks.id')
        ->findAll();

        // Format the dates and handle NULL or '0000-00-00' values
        foreach ($tenants as &$tenant) {
            $tenant['from_date'] = ($tenant['from_date'] && $tenant['from_date'] !== '0000-00-00') ? date('d/m/Y', strtotime($tenant['from_date'])) : '';
            $tenant['to_date'] = ($tenant['to_date'] && $tenant['to_date'] !== '0000-00-00') ? date('d/m/Y', strtotime($tenant['to_date'])) : '';
        }

        // Pass the formatted data to the view
        $data['tenants'] = $tenants;
        $data['menuItems'] = $this->menuItems;
        return view('tenants/index', $data);
    }
    public function add()
    {
        $apartmentId = $this->request->getGet('apartment_id');

    if (!$apartmentId) {
        return redirect()->to('/tenants')->with('status', 'danger')->with('message', 'Apartment ID is required.');
    }

    // Check if an existing tenant has an active lease (i.e., 'to_date' is NULL or in the future)
    $existingTenant = $this->tenantModel
        ->where('apartment_id', $apartmentId)
        ->where('(to_date IS NULL OR to_date >= CURDATE())')
        ->first();

    if ($existingTenant) {
        return redirect()->to('/tenants')->with('status', 'danger')->with('message', 'This apartment is already occupied.');
    }
        $data['menuItems'] = $this->menuItems;
        $data['apartment_id'] = $apartmentId;
        return view('tenants/add', $data);
    }

    public function create()
    {
        $this->tenantModel->save($this->request->getPost());
        return redirect()->to('/tenants');
    }

    public function edit($id)
    {
        $apartmentId = $this->request->getGet('apartment_id');
        $tenant = $this->tenantModel->find($id);
        if (!$tenant) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tenant not found');
        }

        // Fetch only vacant apartments
        // $vacantApartments = $this->tenantModel
        // ->where('apartment_id', $apartmentId)
        // ->where('(to_date IS NULL OR to_date >= CURDATE())')
        // ->first();
        $data['menuItems'] = $this->menuItems;
        $data['tenant'] = $tenant;
        $data['apartment_id'] = $apartmentId;
        return view('tenants/edit', $data);
    }

    public function update($id)
    {
        $this->tenantModel->update($id, $this->request->getPost());
        return redirect()->to('/tenants');
    }

    public function delete($id)
    {
        $this->tenantModel->delete($id);
        return redirect()->to('/tenants');
    }
}
