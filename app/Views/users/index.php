<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Users</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/users/add') ?>" class="btn btn-primary">Add New User</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Apartment No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Status</th>
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
                <td><?= esc($apartment['occupancy']) ?></td>
                <td>
                    <a href="<?= base_url('/apartment/edit/' . $apartment['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/apartment/delete/' . $apartment['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>