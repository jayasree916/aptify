<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        $data['menuItems'] = $this->menuItems; // ✅ Pass menu items
        return view('users/index', $data);
    }
    public function addUser()
    {

        $data = [
            'username'   => 'admin',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'name'       => 'Administrator',
            'address'    => '123 Admin Street, Admin City',
            'email'      => 'admin@example.com',
            'contact_no' => '1234567890',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->userModel->insert($data);

        return 'First user added successfully!';
    }
    // Show add user form
    public function add()
    {
        return view('users/add');
    }

    // Create new user (POST)
    public function create()
    {
        $data = [
            'username'   => $this->request->getPost('username'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name'       => $this->request->getPost('name'),
            'address'    => $this->request->getPost('address'),
            'email'      => $this->request->getPost('email'),
            'contact_no' => $this->request->getPost('contact_no'),
            'user_role'  => $this->request->getPost('user_role'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }

    // Show edit form
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }
        return view('users/edit', $data);
    }

    // Update user (PUT)
    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $data = [
            'username'   => $this->request->getPost('username'),
            'name'       => $this->request->getPost('name'),
            'address'    => $this->request->getPost('address'),
            'email'      => $this->request->getPost('email'),
            'contact_no' => $this->request->getPost('contact_no'),
            'user_role'  => $this->request->getPost('user_role'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Update password only if provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }

    // Delete user
    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->to('/users')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->to('/users')->with('error', 'Failed to delete user.');
        }
    }
}
