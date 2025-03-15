<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ApartmentModel;
use App\Models\FacilityBookingModel;
use App\Models\BillModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $apartmentModel;
    protected $facilityBookingModel;
    protected $billModel;
    protected $billingTypeModel;
    protected $billItemModel;
    protected $userModel;


    public function __construct()
    {
        $this->apartmentModel = new ApartmentModel();
        $this->facilityBookingModel = new FacilityBookingModel();
        $this->billModel = new BillModel();
        // $this->billItemModel = new BillItemModel();
        // $this->paymentModeModel = new PaymentModeModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $apartment_count = $this->apartmentModel->countAllResults(); 
        $booking_count = $this->facilityBookingModel->countAllResults(); 
        $booking_count = $this->facilityBookingModel->countAllResults(); 
        $billing_count = $this->billModel->countAllResults(); 
        $user_count = $this->userModel->countAllResults(); 
        $data = [
            'user' => $user, 
            'apartment_count' => $apartment_count,
            'booking_count' => $booking_count,
            'user_count' => $user_count,
            'billing_count' => $billing_count,
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
