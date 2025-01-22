<?php

namespace App\Controllers;

use App\Models\CollectionsModel;
use CodeIgniter\Controller;

class Collections extends Controller
{
    protected $collectionsModel;


    public function __construct()
    {
        $this->collectionsModel = new CollectionsModel();
    }
    public function processPayment()
    {
        $billId = $this->request->getPost('bill_id');
        $paymentMethod = $this->request->getPost('payment_method');
        $amount = $this->request->getPost('amount');

        // Validate input
        if (!$billId || !$paymentMethod || !$amount) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid input']);
        }

        // Example: Mark bill as paid in the database
        $bill = $this->collectionsModel->find($billId);

        if (!$bill) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Bill not found']);
        }

        // Update the bill's status to 'paid'
        $this->collectionsModel->update($billId, [
            'status' => 'paid',
            'payment_method' => $paymentMethod,
            'payment_date' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Payment successful']);
    }

}
