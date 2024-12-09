<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApartmentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Apartment extends BaseController
{
    protected $apartmentModel;

    public function __construct()
    {
        $this->apartmentModel = new ApartmentModel();
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
            'apartment_no' => 'required|is_unique[apartment.apartment_no]',
            'owner_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'block' => 'required',
            'type' => 'required',
            'occupancy' => 'required',
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
            'occupancy' => $this->request->getPost('occupancy'),
            'created_by' => session()->get('user_id'), // Assuming user_id is in session
            'updated_by' => session()->get('user_id'),
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
            'type' => 'required',
            'occupancy' => 'required',
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
            'occupancy' => $this->request->getPost('occupancy'),
            'updated_by' => session()->get('user_id'),
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
}
