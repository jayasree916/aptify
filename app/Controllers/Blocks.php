<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlocksModel;
use CodeIgniter\HTTP\ResponseInterface;

class Blocks extends BaseController
{
    protected $blocksModel;

    public function __construct()
    {
        $this->blocksModel = new BlocksModel();
    }
    public function index()
    {
        $data['blocks'] = $this->blocksModel->findAll();
        $data['menuItems'] = $this->menuItems; // ✅ Pass menu items
        return view('blocks/index', $data);
    }
    public function add()
    {
        $data['menuItems'] = $this->menuItems; // ✅ Pass menu items
        return view('blocks/add', $data);
    }

    public function create()
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->blocksModel->insert($data);
        return redirect()->to('/blocks');
    }

    public function edit($id)
    {
        $data['block'] = $this->blocksModel->find($id);
        $data['menuItems'] = $this->menuItems; // ✅ Pass menu items
        return view('blocks/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->blocksModel->update($id, $data);
        return redirect()->to('/blocks');
    }

    public function delete($id)
    {
        $this->blocksModel->delete($id);
        return redirect()->to('/blocks');
    }
}
