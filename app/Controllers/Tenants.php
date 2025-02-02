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
        ->select('tenants.*, apartments.apartment_no, apartments.block')
        ->join('apartments', 'tenants.apartment_id = apartments.id')
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
        $vacantApartments = $this->apartmentModel->where('occupancy', 'vacant')->findAll();
        $data['menuItems'] = $this->menuItems;
        $data['vacantApartments'] = $vacantApartments;
        return view('tenants/add', $data);
    }

    public function create()
    {
        $this->tenantModel->save($this->request->getPost());
        return redirect()->to('/tenants');
    }

    public function edit($id)
    {
        $tenant = $this->tenantModel->find($id);
        if (!$tenant) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tenant not found');
        }

        // Fetch only vacant apartments
        $vacantApartments = $this->apartmentModel
        ->where('occupancy', 'vacant')
        ->orWhere('id', $tenant['apartment_id']) // Include current apartment if already assigned
        ->findAll();
        $data['menuItems'] = $this->menuItems;
        $data['tenant'] = $tenant;
        $data['vacantApartments'] = $vacantApartments;
        // Pass data to the view
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
