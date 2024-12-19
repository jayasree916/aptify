<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Add New Tenant</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/tenants/add') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="apartment_id">Apartment</label>
        <select class="form-control" id="apartment_id" name="apartment_id" required>
            <option value="">-- Select Apartment --</option>
            <?php foreach ($vacantApartments as $apartment): ?>
                <option value="<?= $apartment['id'] ?>" <?= old('apartment_id') == $apartment['id'] ? 'selected' : '' ?>>
                    <?= $apartment['apartment_no'] ?> (Block: <?= $apartment['block'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tenant_name">Tenant Name</label>
        <input type="text" class="form-control" id="tenant_name" name="tenant_name" value="<?= old('tenant_name') ?>" required style="text-transform: capitalize;">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" required><?= old('address') ?></textarea>
    </div>

    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= old('contact_number') ?>" required pattern="^\d{10}$" maxlength="10" title="Contact number must be exactly 10 digits.">
    </div>
    
    <div class="form-group">
        <label for="from_date">From Date</label>
        <input type="date" class="form-control" id="from_date" name="from_date" value="<?= old('from_date') ?>" required>
    </div>

    <div class="form-group">
        <label for="to_date">To Date</label>
        <input type="date" class="form-control" id="to_date" name="to_date" value="<?= old('to_date') ?>">
    </div>

    <div class="form-group">
        <label for="remarks">Remarks</label>
        <textarea class="form-control" id="remarks" name="remarks"><?= old('remarks') ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Save Tenant</button>
    </div>
</form>

<?= $this->endSection() ?>