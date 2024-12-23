<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Apartments</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/apartment/add') ?>" class="btn btn-primary">Add New Apartment</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Apartment No</th>
            <th>Owner Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Block</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($apartments as $apartment): ?>
            <tr>
                <td><?= esc($apartment['apartment_no']) ?></td>
                <td><?= esc($apartment['owner_name']) ?></td>
                <td><?= esc($apartment['address']) ?></td>
                <td><?= esc($apartment['contact_no']) ?></td>
                <td><?= esc($apartment['block']) ?></td>
                <td><?= esc($apartment['type']) ?></td>
                <td>
                    <a href="<?= base_url('/apartment/view/' . $apartment['id']) ?>" class="btn btn-info">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>