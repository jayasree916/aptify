<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacilityBookingModel;
use App\Models\FacilityModel;
use CodeIgniter\HTTP\ResponseInterface;

class FacilityBookings extends BaseController
{
    protected $bookingModel;
    protected $facilityModel;
    
    public function __construct()
    {
        $this->bookingModel = new FacilityBookingModel();
        $this->facilityModel = new FacilityModel();
    }

    public function index()
    {
        $data['requests'] = $this->bookingModel->select('facility_bookings.*, apartments.name AS apartment, blocks.name AS block, facilities.name AS facility, users.name AS applied_by')
        ->join('apartments', 'apartments.id = facility_bookings.apartment_id', 'left')
        ->join('blocks', 'blocks.id = apartments.block_id', 'left')
        ->join('facilities', 'facilities.id = facility_bookings.facility_id', 'left')
        ->join('users', 'users.id = facility_bookings.created_by', 'left')
        ->where('facility_bookings.status', 'pending')->findAll();

        $data['bookings'] = $this->bookingModel->select('facility_bookings.*, apartments.name AS apartment, blocks.name AS block, facilities.name AS facility, users.name AS applied_by')
        ->join('apartments', 'apartments.id = facility_bookings.apartment_id', 'left')
        ->join('blocks', 'blocks.id = apartments.block_id', 'left')
        ->join('facilities', 'facilities.id = facility_bookings.facility_id', 'left')
        ->join('users', 'users.id = facility_bookings.created_by', 'left')
        ->where('facility_bookings.status !=', 'pending')
        ->where('facility_bookings.booking_date >=', date('Y-m-d'))
        ->orderBy('facility_bookings.booking_date', 'ASC')
        ->orderBy('facility_bookings.time_from', 'ASC')
        ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('facility_bookings/index', $data);
    }

    public function add()
    {
        $data['facilities'] = $this->facilityModel->findAll();
        $data['bookings'] = $this->bookingModel->select('facility_bookings.*, apartments.name AS apartment, blocks.name AS block, facilities.name AS facility')
        ->join('apartments', 'apartments.id = facility_bookings.apartment_id', 'left')
        ->join('blocks', 'blocks.id = apartments.block_id', 'left')
        ->join('facilities', 'facilities.id = facility_bookings.facility_id', 'left')
        ->where('facility_bookings.created_by', session()->get('user_id'))
        ->orderBy('facility_bookings.booking_date', 'DESC')
        ->orderBy('facility_bookings.time_from', 'DESC')
        ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('facility_bookings/add', $data);
    }
    
    public function store()
    {
        $facilityId  = $this->request->getPost('facility');
    $bookingDate = $this->request->getPost('booking_date');
    $timeFrom    = $this->request->getPost('time_from');
    $timeTo      = $this->request->getPost('time_to');

    // Check if a booking already exists for the same facility, date, and overlapping time slot
    $existingBooking = $this->bookingModel
        ->where('facility_id', $facilityId)
        ->where('booking_date', $bookingDate)
        ->where("(time_from < '$timeTo' AND time_to > '$timeFrom')") // Check for overlapping time
        ->first();

    if ($existingBooking) {
        return redirect()->back()->with('error', 'This facility is already booked for the selected time slot. Please choose a different time.')->withInput();
    } else {
        $this->bookingModel->save([
            'apartment_id' => '3',
            'facility_id'  => $this->request->getPost('facility'),
            'booking_date' => $this->request->getPost('booking_date'),
            'time_from' => $this->request->getPost('time_from'),
            'time_to' => $this->request->getPost('time_to'),
            'status' => 'pending',
            'description' => $this->request->getPost('description'),
            'created_by' => session()->get('user_id'), // Change this based on authentication
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('user_id'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->to('/facility_bookings/add');
    }
    }

    public function approve($id)
    {
        $this->bookingModel->update($id, ['status' => 'approved',
        'status_updated_by' => session()->get('user_id'),
        'status_updated_at' => date('Y-m-d H:i:s')]);
        return redirect()->to('/facility_bookings');
    }

    public function reject($id)
    {
        $this->bookingModel->update($id, ['status' => 'rejected',
        'status_updated_by' => session()->get('user_id'),
        'status_updated_at' => date('Y-m-d H:i:s')]);
        return redirect()->to('/facility_bookings');
    }

    public function edit($id)
    {
        $data = [
            'facility' => $this->facilityModel->find($id),
            'menuItems' => $this->menuItems
        ];
        return view('facility_bookings/edit', $data);
    }

    public function update($id)
    {

        $this->facilityModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'updated_by' => session()->get('user_id'), // Change this based on authentication
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/facility_bookings/add')->with('success', 'Facility booking updated successfully.');
    }

    public function delete($id)
    {
        $this->bookingModel->delete($id);
        return redirect()->to('/facility_bookings/add')->with('success', 'Facility booking deleted successfully.');
    }
}
