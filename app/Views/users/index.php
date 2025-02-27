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
            <th>Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['name']) ?></td>
                <td><?= esc($user['address']) ?></td>
                <td><?= esc($user['contact_no']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['role_name']) ?></td>
                <td>
                    <a href="<?= base_url('/users/edit/' . $user['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/users/delete/' . $user['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>