<?php

namespace App\Controllers;

use App\Models\CollectionsModel;
use App\Models\BillModel;
use CodeIgniter\Controller;

class Collections extends BaseController
{
    protected $collectionsModel;
    protected $billModel;


    public function __construct()
    {
        $this->collectionsModel = new CollectionsModel();
        $this->billModel = new BillModel();
    }
    public function processPayment()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'date_of_payment' => 'required|valid_date',
            'bill_id' => 'required|integer',
            'payment_mode' => 'required|integer',
            'amount' => 'required|decimal',
            'paid_by' => 'required|string|max_length[255]',
            'narration' => 'string|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('status', 'danger')->with('message', 'Validation failed.')->with('errors', $errors);
        }

        // Collect data from the form
        $data = [
            'date' => $this->request->getPost('date_of_payment'),
            'bill_id' => $this->request->getPost('bill_id'),
            'bill_no' => $this->request->getPost('bill_no'),
            'trans_type' => '1',
            'payment_mode' => $this->request->getPost('payment_mode'),
            'billing_type' => '0',
            'amount' => $this->request->getPost('amount'),
            'paid_by' => $this->request->getPost('paid_by'),
            'Remarks' => $this->request->getPost('narration'),
            'created_by' => $this->session->get('user_id'), // Assuming user_id is stored in the session
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->get('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Insert data into collections table
        if ($this->collectionsModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Payment recorded successfully.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to record payment.',
            ]);
        }
    }

}
