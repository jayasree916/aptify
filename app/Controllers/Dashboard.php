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
            'apartment_count' => 0, //$this->getApartmentCount(),
            'tenant_count' => 0, //$this->getTenantCount(),
            'user_count' => 0, //$this->getUserCount(),
            'billing_count' => 0, //$this->getBillingCount(),
            'payment_received' => 0, //$this->getTotalPayments(),
            'maintenance_requests' => 0, //$this->getMaintenanceRequests(),
            'menuItems' => $this->menuItems, // ✅ Pass menu items
        ];

        return view('content/dashboard', $data);
        // $data = [
        //     'user' => $user,
            
        // ];
        // return view('content/dashboard', $data);
    }

}
