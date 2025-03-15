<?php

namespace App\Controllers;

use App\Models\CollectionsModel;
use App\Models\BillModel;
use App\Models\BillingTypeModel;
use App\Models\BillItemModel;
use App\Models\PaymentModeModel;
use App\Models\ReceiptGeneratorModel;
use CodeIgniter\Controller;

class Collections extends BaseController
{
    protected $collectionsModel;
    protected $billModel;
    protected $paymentModeModel;
    protected $billingTypeModel;
    protected $billItemModel;
    protected $receiptGeneratorModel;


    public function __construct()
    {
        $this->collectionsModel = new CollectionsModel();
        $this->billModel = new BillModel();
        $this->billingTypeModel = new BillingTypeModel();
        $this->billItemModel = new BillItemModel();
        $this->paymentModeModel = new PaymentModeModel();
        $this->receiptGeneratorModel = new ReceiptGeneratorModel();
    }
    public function index()
    {
        $data['payments'] = $this->collectionsModel
            ->select('collections.*, payment_modes.mode as payment_mode')
            ->join('payment_modes', 'payment_modes.id = collections.payment_mode', 'left')
            ->where('collections.trans_type', '2')
            ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('payments/index', $data);
    }

    public function add()
    {
        $data['bill_types'] = $this->billingTypeModel->findAll();
        $data['payment_modes'] = $this->paymentModeModel->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('payments/add', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'date_of_payment' => 'required|valid_date',
            'bill_type' => 'required|integer',
            'payment_mode' => 'required|integer',
            'amount' => 'required|decimal',
            'paid_to' => 'required|string|max_length[255]',
            'narration' => 'string|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('status', 'danger')->with('message', 'Validation failed.')->with('errors', $errors);
        }
        $last_receipt_no = $this->receiptGeneratorModel
        ->where('year', date('Y')) 
        ->where('receipt_group', 2) 
        ->first(); 
        $receipt_no = $last_receipt_no ? $last_receipt_no['last_receipt_no']+1 : 1;
        // Collect data from the form
        $data = [
            'date' => $this->request->getPost('date_of_payment'),
            'bill_id' => '0',
            'bill_no' => '0',
            'receipt_year' => date('Y'),
            'receipt_no' => $receipt_no,
            'trans_type' => '2',
            'payment_mode' => $this->request->getPost('payment_mode'),
            'billing_type' => $this->request->getPost('bill_type'),
            'billing_item' => $this->billingTypeModel->find($this->request->getPost('bill_type'))['billing_type'] ?? '',
            'amount' => $this->request->getPost('amount'),
            'paid_by' => $this->request->getPost('paid_to'),
            'Remarks' => $this->request->getPost('narration'),
            'created_by' => $this->session->get('user_id'), // Assuming user_id is stored in the session
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->get('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if ($this->collectionsModel->insert($data)) {
            if ($last_receipt_no['last_receipt_no']) {
                $updateReceiptno = $this->receiptGeneratorModel->update($last_receipt_no['id'], [
                    'last_receipt_no' => $receipt_no
                ]);
            } else {
                $updateReceiptno = $this->receiptGeneratorModel->insert([
                    'year' => date('Y'),
                    'receipt_group' => '2',
                    'last_receipt_no' => '1'
                ]);
            }
            return redirect()->to('/payments');
        } else {
            return redirect()->back()->withInput()->with('status', 'danger')->with('errors', 'Insertion failed. Please try again');
        }
    }
    public function processPayment()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'date_of_payment' => 'required|valid_date',
            'bill_id' => 'required|integer',
            'apartment_id' => 'required|integer',
            'payment_mode' => 'required|integer',
            'amount' => 'required|decimal',
            'paid_by' => 'required|string|max_length[255]',
            'narration' => 'string|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('status', 'danger')->with('message', 'Validation failed.')->with('errors', $errors);
        }
        $items = $this->billItemModel->where('bill_id', $this->request->getPost('bill_id'))->orderBy('id', 'ASC')->findAll();
        $last_receipt_no = $this->receiptGeneratorModel
        ->where('year', date('Y')) 
        ->where('receipt_group', 1) 
        ->first(); 
        $receipt_no = $last_receipt_no ? $last_receipt_no['last_receipt_no']+1 : 1;
        $data = []; 
        foreach ($items as $item) {
            // Collect data from the form
            $data[] = [
                'date' => $this->request->getPost('date_of_payment'),
                'bill_id' => $this->request->getPost('bill_id'),
                'bill_no' => $this->request->getPost('bill_no'),
                'receipt_year' => date('Y'),
                'receipt_no' => $receipt_no,
                'trans_type' => '1',
                'payment_mode' => $this->request->getPost('payment_mode'),
                'billing_type' => $item['bill_type_id'],
                'billing_item' => $item['item_name'],
                'amount' => $item['amount'],
                'apartment_id' => $this->request->getPost('apartment_id'),
                'paid_by' => $this->request->getPost('paid_by'),
                'Remarks' => $this->request->getPost('narration'),
                'created_by' => $this->session->get('user_id'), // Assuming user_id is stored in the session
                'created_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->get('user_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        $update_data = [
            'paid' => '1',
            'paid_at' => date('Y-m-d H:i:s'),
        ];
        $db = \Config\Database::connect(); // Get the database connection
        $db->transStart(); // Start the transaction
        $insertSuccess = $this->collectionsModel->insertBatch($data);
        if ($insertSuccess) {
            $updateSuccess = $this->billModel->update($this->request->getPost('bill_id'), $update_data);
            if ($updateSuccess) {
                if ($last_receipt_no && ($last_receipt_no['last_receipt_no']>0)) {
                    $updateReceiptno = $this->receiptGeneratorModel->update($last_receipt_no['id'], [
                        'last_receipt_no' => $receipt_no
                    ]);
                } else {
                    $updateReceiptno = $this->receiptGeneratorModel->insert([
                        'year' => date('Y'),
                        'receipt_group' => '1',
                        'last_receipt_no' => '1'
                    ]);
                }
                if($updateReceiptno) {
                    $db->transCommit(); // Commit the transaction
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Payment recorded successfully.',
                ]);
                } else {
                    $db->transRollback(); // Rollback the transaction
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to update bill status.',
                    ]);
            }
            } else {
                $db->transRollback(); // Rollback the transaction
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update bill status.',
                ]);
            }
        } else {
            $db->transRollback(); // Rollback the transaction
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to record payment.',
            ]);
        }
    }

    public function advancePayment()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'date_of_payment' => 'required|valid_date',
            'apartment_id' => 'required|integer',
            'payment_mode' => 'required|integer',
            'amount' => 'required|decimal',
            'paid_by' => 'required|string|max_length[255]',
            'narration' => 'string|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            $this->session->setFlashdata('error', $errors);
            return redirect()->back()->withInput();
        }
        $last_receipt_no = $this->receiptGeneratorModel
        ->where('year', date('Y')) 
        ->where('receipt_group', 1) 
        ->first(); 
        $receipt_no = $last_receipt_no ? $last_receipt_no['last_receipt_no']+1 : 1;
        // Collect data from the form
        $data = [
            'date' => $this->request->getPost('date_of_payment'),
            'apartment_id' => $this->request->getPost('apartment_id'),
            'bill_no' => '0',
            'receipt_year' => date('Y'),
            'receipt_no' => $receipt_no,
            'trans_type' => '3',
            'payment_mode' => $this->request->getPost('payment_mode'),
            'billing_type' => '0',
            'billing_item' => 'Advance Payment',
            'amount' => $this->request->getPost('amount'),
            'paid_by' => $this->request->getPost('paid_by'),
            'Remarks' => $this->request->getPost('narration'),
            'created_by' => $this->session->get('user_id'), // Assuming user_id is stored in the session
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->get('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->collectionsModel->insert($data)) {
            if ($last_receipt_no['last_receipt_no']) {
                $this->receiptGeneratorModel->update($last_receipt_no['id'], [
                    'last_receipt_no' => $receipt_no
                ]);
            } else {
                $this->receiptGeneratorModel->insert([
                    'year' => date('Y'),
                    'receipt_group' => '1',
                    'last_receipt_no' => '1'
                ]);
            }
            session()->remove('error');
            $this->session->setFlashdata('success', 'Advance receipt recorded successfully.');
            return redirect()->back()->withInput();
        } else {
            $this->session->setFlashdata('error', 'Failed to record advance receipt.');
            return redirect()->back()->withInput();
        }
    }
}
