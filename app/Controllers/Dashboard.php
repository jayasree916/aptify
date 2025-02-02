<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        $userModel = new UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        $data = [
            'user' => $user,
            'menuItems' => $this->menuItems, // ✅ Pass menu items
        ];
        return view('content/dashboard', $data);
    }

}
