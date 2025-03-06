<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Add Owner</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/owners/add') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="apartment_no">Apartment No</label>
        <select class="form-control" id="apartment_no" name="apartment_no" required>
            <option value="">-- Select Apartment --</option>
            <?php foreach ($apartments as $apartment): ?>
                <option value="<?= $apartment['id'] ?>" <?= old('apartment_no') == $apartment['id'] ? 'selected' : '' ?>>
                    <?= $apartment['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="owner_name">Name</label>
        <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?= old('owner_name') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="contact_no">Mobile Number</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?= old('contact_no') ?>" required pattern="^\d{10}$" maxlength="10" title="Contact number must be exactly 10 digits.">
    </div>

    <div class="form-group">
        <label for="block">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
    </div>

    <div class="form-group">
        <label for="from_date">From Date</label>
        <input type="date" class="form-control" id="from_date" name="from_date" value="<?= old('from_date') ?>" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>

<?= $this->endSection() ?>