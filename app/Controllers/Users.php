<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function index()
    {
        //
    }
    public function addUser()
    {
        $userModel = new UserModel();

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

        $userModel->insert($data);

        return 'First user added successfully!';
    }
}
