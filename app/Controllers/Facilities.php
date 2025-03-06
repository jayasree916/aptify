<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacilityModel;
use CodeIgniter\HTTP\ResponseInterface;

class Facilities extends BaseController
{
    protected $facilityModel;
    public function __construct()
    {
        $this->facilityModel = new FacilityModel();
    }

    public function index()
    {
        $data['facilities'] = $this->facilityModel->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('facilities/index', $data);
    }

    public function add()
    {
        $data['menuItems'] = $this->menuItems;
        return view('facilities/add', $data);
    }

    public function store()
    {
        $this->facilityModel->save([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'created_by' => session()->get('user_id'), // Change this based on authentication
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('user_id'), // Change this based on authentication
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->to('/facilities');
    }

    public function edit($id)
    {
        $data = [
            'facility' => $this->facilityModel->find($id),
            'menuItems' => $this->menuItems
        ];
        return view('facilities/edit', $data);
    }

    public function update($id)
    {

        $this->facilityModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'updated_by' => session()->get('user_id'), // Change this based on authentication
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/facilities')->with('success', 'Facility updated successfully.');
    }

    public function delete($id)
    {
        $this->facilityModel->delete($id);
        return redirect()->to('/facilities')->with('success', 'Facility deleted successfully.');
    }
}
