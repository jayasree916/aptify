<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Monthly Bills</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/billing/add') ?>" class="btn btn-primary">Generate New Bills</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Apartment</th>
            <th>Tenant</th>
            <th>Year</th>
            <th>Month</th>
            <th>Amount</th>
            <th>Bill Date</th>
            <th>Due Date</th>
            <th>Paid Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bills as $bill): ?>
            <tr>
                <td><?= esc($bill['bill_no']) ?></td>
                <td><?= esc($bill['owner_name']) ?></td>
                <td><?= esc($bill['tenant_name'] ?? 'N/A') ?></td>
                <td><?= esc($bill['year']) ?></td>
                <td><?= esc($bill['month']) ?></td>
                <td><?= esc(number_format($bill['amount'], 2)) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($bill['issued_date']))) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($bill['due_date']))) ?></td>
                <td><?= $bill['paid'] ? 'Paid' : 'Pending' ?></td>
                <td>
                    <a href="<?= base_url('/billing/edit/' . $bill['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/billing/delete/' . $bill['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>