<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApartmentModel;
use App\Models\BlockModel;
use App\Models\ParkingTypeModel;
use App\Models\ApartmentTypeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Apartments extends BaseController
{
    protected $apartmentModel;
    protected $blockModel;
    protected $parkingTypeModel;
    protected $apartmentTypeModel;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->apartmentModel = new ApartmentModel();
        $this->blockModel = new BlockModel();
        $this->parkingTypeModel = new ParkingTypeModel();
        $this->apartmentTypeModel = new ApartmentTypeModel();
    }
    public function index()
    {
        //$data['apartments'] = $this->apartmentModel->findAll();
        $data['apartments'] = $this->apartmentModel->select('apartments.*, blocks.name AS block_name, 
                              apartment_types.name AS apartment_type_name, 
                              parking_types.name AS parking_type_name')
                    ->join('blocks', 'blocks.id = apartments.block_id', 'left')
                    ->join('apartment_types', 'apartment_types.id = apartments.apartment_type_id', 'left')
                    ->join('parking_types', 'parking_types.id = apartments.parking_type_id', 'left')
                    ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('apartments/index', $data);
    }

    public function add()
    {
        $data = [
            'blocks' => $this->blockModel->findAll(),
            'parkingTypes' => $this->parkingTypeModel->findAll(),
            'apartmentTypes' => $this->apartmentTypeModel->findAll(),
        ];
        $data['menuItems'] = $this->menuItems;
        return view('apartments/add', $data);
    }

    // public function create()
    // {
    //     $data['menuItems'] = $this->menuItems;
    //     return view('apartments/create');
    // }

    public function create()
    {

        $this->apartmentModel->insert([
            'block_id' => $this->request->getPost('block'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'parking_type_id' => $this->request->getPost('parking_type'),
            'apartment_type_id' => $this->request->getPost('apartment_type'),
            'created_by' => session()->get('user_id'), // Change this based on authentication
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('user_id'), // Change this based on authentication
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/apartments')->with('success', 'Apartment added successfully.');
    }

    public function edit($id)
    {
        $data = [
            'apartment' => $this->apartmentModel->find($id),
            'blocks' => $this->blockModel->findAll(),
            'parkingTypes' => $this->parkingTypeModel->findAll(),
            'apartmentTypes' => $this->apartmentTypeModel->findAll(),
            'menuItems' => $this->menuItems
        ];
        return view('apartments/edit', $data);
    }

    public function update($id)
    {

        $this->apartmentModel->update($id, [
            'block_id' => $this->request->getPost('block'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'parking_type_id' => $this->request->getPost('parking_type'),
            'apartment_type_id' => $this->request->getPost('apartment_type'),
            'updated_by' => session()->get('user_id'), // Change this based on authentication
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/apartments')->with('success', 'Apartment updated successfully.');
    }

    public function delete($id)
    {
        $this->apartmentModel->delete($id);
        return redirect()->to('/apartments')->with('success', 'Apartment deleted successfully.');
    }
}
