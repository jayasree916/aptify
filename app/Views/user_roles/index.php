<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>User Roles</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/user-roles/add') ?>" class="btn btn-primary">Add New User Role</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Role Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody
        <?php foreach ($roles as $i => $role): ?>
        <tr>
        <td><?= $i ?></td>
        <td><?= $role['role_name'] ?></td>
        <td><?= $role['description'] ?></td>
        <td>
            <a href="/user-roles/edit/<?= $role['id'] ?>" class="btn btn-warning">Edit</a>
            <a href="/user-roles/delete/<?= $role['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>