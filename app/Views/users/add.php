<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Add New User Role</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?= base_url('/user-roles/add') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="role_name">Role Name</label>
        <input type="text" class="form-control" id="role_name" name="role_name" value="<?= old('role_name') ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Save Role</button>
    </div>
</form>

<?= $this->endSection() ?>