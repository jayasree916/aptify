<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CollectionsModel;
use App\Models\BillModel;
use App\Models\BillingTypeModel;
use App\Models\BillItemModel;
use App\Models\PaymentModeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Receipts extends BaseController
{
    protected $collectionsModel;
    protected $billModel;
    protected $paymentModeModel;
    protected $billingTypeModel;
    protected $billItemModel;


    public function __construct()
    {
        $this->collectionsModel = new CollectionsModel();
        $this->billModel = new BillModel();
        $this->billingTypeModel = new BillingTypeModel();
        $this->billItemModel = new BillItemModel();
        $this->paymentModeModel = new PaymentModeModel();
    }
    public function index()
    {
        $data['receipts'] = $this->collectionsModel
            ->select('collections.*, payment_modes.mode as payment_mode')
            ->join('payment_modes', 'payment_modes.id = collections.payment_mode', 'left')
            ->where('collections.trans_type', '1')
            ->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('receipts/index', $data);
    }

    public function add()
    {
        $data['bill_types'] = $this->billingTypeModel->findAll();
        $data['payment_modes'] = $this->paymentModeModel->findAll();
        $data['menuItems'] = $this->menuItems;
        return view('receipts/add', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'date_of_payment' => 'required|valid_date',
            'bill_type' => 'required|integer',
            'payment_mode' => 'required|integer',
            'amount' => 'required|decimal',
            'paid_by' => 'required|string|max_length[255]',
            'narration' => 'string|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('status', 'danger')->with('message', 'Validation failed.')->with('errors', $errors);
        }
        $last_receipt_no = $this->receiptGeneratorModel
        ->where('year', date('Y')) 
        ->where('receipt_group', 1) 
        ->first(); 
        $receipt_no = $last_receipt_no ? $last_receipt_no['last_receipt_no']+1 : 1;
        // Collect data from the form
        $data = [
            'date' => $this->request->getPost('date_of_payment'),
            'bill_id' => '0',
            'bill_no' => '0',
            'receipt_year' => date('Y'),
            'receipt_no' => $receipt_no,
            'trans_type' => '1',
            'payment_mode' => $this->request->getPost('payment_mode'),
            'billing_type' => $this->request->getPost('bill_type'),
            'billing_item' => $this->billingTypeModel->find($this->request->getPost('bill_type'))['billing_type'] ?? '',
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
            return redirect()->to('/receipts');
        } else {
            return redirect()->back()->withInput()->with('status', 'danger')->with('errors', 'Insertion failed. Please try again');
        }
    }

}
