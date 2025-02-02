<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserRolesModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserRoles extends BaseController
{
    protected $userRolesModel;

    public function __construct()
    {
        $this->userRolesModel = new UserRolesModel();
    }

    public function index()
    {
        $data['roles'] = $this->userRolesModel->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('user_roles/index', $data);
    }

    public function add()
    {
        $data['menuItems'] = $this->menuItems;
        return view('user_roles/add', $data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (empty($data['role_name']) || empty($data['description'])) {
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
        $this->userRolesModel->insert($data);
        session()->setFlashdata('status', 'success');
        session()->setFlashdata('message', 'User role inserted successfully.');
        return redirect()->to('/user-roles');
    }

    public function edit($id)
    {
        $data['role'] = $this->userRolesModel->find($id);
        $data['menuItems'] = $this->menuItems;
        return view('user_roles/edit', $data);
    }

    public function update($id)
    {
        $this->userRolesModel->update($id, [
            'role_name' => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/user-roles')->with('message', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $this->userRolesModel->delete($id);
        return redirect()->to('/user-roles')->with('message', 'Role deleted successfully.');
    }
}
