<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Add New User Role</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="/users/edit/<?= $user['id'] ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" required><?= $user['address'] ?></textarea>
    </div>
    <div class="form-group">
    <label for="contact_no">Contact Number</label>
    <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?= $user['contact_no'] ?>" 
        required pattern="^[6-9]\d{9}$" title="Enter a valid 10-digit mobile number starting with 6-9">
    <small class="text-danger" id="contact_error"></small>
</div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" id="user_role" name="user_role" required>
            <option value="">-- Select Role --</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>" <?php if($role['id'] == $user['user_role']) : ?> selected <?php endif; ?>><?= $role['role_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $user['username'] ?>" required>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>

<?= $this->endSection() ?>