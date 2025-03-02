<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlockModel;
use CodeIgniter\HTTP\ResponseInterface;

class Blocks extends BaseController
{
    protected $blockModel;

    public function __construct()
    {
        $this->blockModel = new BlockModel();
    }
    public function index()
    {
        $data['blocks'] = $this->blockModel->findAll();
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
        $this->blockModel->insert($data);
        return redirect()->to('/blocks');
    }

    public function edit($id)
    {
        $data['block'] = $this->blockModel->find($id);
        $data['menuItems'] = $this->menuItems; // ✅ Pass menu items
        return view('blocks/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->blockModel->update($id, $data);
        return redirect()->to('/blocks');
    }

    public function delete($id)
    {
        $this->blockModel->delete($id);
        return redirect()->to('/blocks');
    }
}
