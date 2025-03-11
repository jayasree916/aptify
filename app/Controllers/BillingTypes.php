<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillingTypeModel;
use CodeIgniter\HTTP\ResponseInterface;

class BillingTypes extends BaseController
{
    protected $billingTypeModel;

    public function __construct()
    {
        $this->billingTypeModel = new BillingTypeModel();
    }

    public function index()
    {
        $billingTypes = $this->billingTypeModel->findAll();
        $data['menuItems'] = $this->menuItems;
        $data['billingTypes'] = $billingTypes;
        return view('billing_types/index', $data);
    }

    public function add()
    {
        $data['menuItems'] = $this->menuItems;
        return view('billing_types/add', $data);
    }

    public function store()
    {        // Get form data
        $data = $this->request->getPost();
        if (empty($data['billing_type']) || empty($data['default_charge'])) {
            return redirect()->back()->with('error', 'Please fill in all required fields');
            session()->setFlashdata('status', 'error');
            session()->setFlashdata('message', 'Please fill in all required fields');
        }

        // Add created_by to data before inserting
        $data['created_by'] = session()->get('user_id');
        $data['updated_by'] = session()->get('user_id');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] =  date('Y-m-d H:i:s');
        // Insert data into the model
        $this->billingTypeModel->insert($data);
        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'Billing type inserted successfully.');
        return redirect()->to('/billing-types');
    }


    public function edit($id)
    {
        $billingType = $this->billingTypeModel->find($id);
        return view('billing_types/edit', ['billingType' => $billingType, 'menuItems' => $this->menuItems]);
    }

    public function update($id)
    {
        $this->billingTypeModel->update($id, [
            'billing_type' => $this->request->getPost('billing_type'),
            'description' => $this->request->getPost('description'),
            'default_charge' => $this->request->getPost('default_charge'),
            'updated_by' => session()->get('user_id'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);
        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'Billing type updated successfully.');
        return redirect()->to('/billing-types');
    }

    public function delete($id)
    {
        $this->billingTypeModel->delete($id);
        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'Billing type deleted successfully.');
        return redirect()->to('/billing-types');
    }
}
