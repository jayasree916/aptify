<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit User Role</h1>

<form action="/user-roles/edit/<?= $role['id'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="role_name">Role Name</label>
        <input class="form-control" type="text" name="role_name" id="role_name" value="<?= $role['role_name'] ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= $role['description'] ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Role</button>
    </div>
</form>

<?= $this->endSection() ?>