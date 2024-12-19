<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Billing Types</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/billing-types/create') ?>" class="btn btn-primary">Add New Billing Type</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Billing Type</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($billingTypes as $index => $billingType): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= esc($billingType['billing_type']) ?></td>
                <td><?= esc($billingType['description']) ?></td>
                <td><?= esc($billingType['default_charge']) ?></td>
                <td>
                    <a href="<?= base_url('/billing-types/edit/' . $billingType['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/billing-types/delete/' . $billingType['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>