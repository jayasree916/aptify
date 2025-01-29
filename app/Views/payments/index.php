<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Payments</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/payments/add') ?>" class="btn btn-primary">Add Payment</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Date</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Mode of Payment</th>
            <th>Paid To</th>
            <th>Narration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?= esc($payment['bill_no']) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($payment['date']))) ?></td>
                <td><?= esc($payment['tenant_name'] ?? 'N/A') ?></td>
                <td><?= esc(number_format($payment['amount'], 2)) ?></td>
                <td><?= esc($payment['payment_mode']) ?></td>
                <td><?= esc($payment['paid_by']) ?></td>
                <td><?= esc($payment['remarks']) ?></td>
                <td>
                    <a href="<?php // echo base_url('/billing/edit/' . $payment['id']) ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>