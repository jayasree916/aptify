<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Receipts</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/receipts/add') ?>" class="btn btn-primary">Add Receipt</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Date</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Mode of Payment</th>
            <th>Paid By</th>
            <th>Narration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($receipts as $receipt): ?>
            <tr>
                <td><?= esc($receipt['bill_no']) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($receipt['date']))) ?></td>
                <td><?= esc($receipt['billing_item']) ?></td>
                <td><?= esc(number_format($receipt['amount'], 2)) ?></td>
                <td><?= esc($receipt['payment_mode']) ?></td>
                <td><?= esc($receipt['paid_by']) ?></td>
                <td><?= esc($receipt['remarks']) ?></td>
                <td>
                    <!-- <a href="<?php // echo base_url('/billing/edit/' . $payment['id']) ?>" class="btn btn-warning">Edit</a> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>