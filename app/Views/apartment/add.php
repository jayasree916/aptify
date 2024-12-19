<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Add New Apartment</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/apartment/add') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="apartment_no">Apartment No</label>
        <input type="text" class="form-control" id="apartment_no" name="apartment_no" value="<?= old('apartment_no') ?>" required>
    </div>

    <div class="form-group">
        <label for="owner_name">Onwer Name</label>
        <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?= old('owner_name') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="contact_no">Contact Number</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?= old('contact_no') ?>" required pattern="^\d{10}$" maxlength="10" title="Contact number must be exactly 10 digits.">
    </div>

    <div class="form-group">
        <label for="block">Block</label>
        <input type="text" class="form-control" id="block" name="block" value="<?= old('block') ?>" required style="text-transform: uppercase;" maxlength="5">
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= old('type') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="occupancy">Occupancy</label>
        <select class="form-control" id="occupancy" name="occupancy" required>
            <option value="vacant" <?= old('occupancy') == 'vacant' ? 'selected' : '' ?>>Vacant</option>
            <option value="occupied" <?= old('occupancy') == 'occupied' ? 'selected' : '' ?>>Occupied</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Save Apartment</button>
    </div>
</form>

<?= $this->endSection() ?>