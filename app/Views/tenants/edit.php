<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Tenant</h1>

<form action="<?= base_url('/tenants/edit/' . $tenant['id']) ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" class="form-control" id="apartment_id" name="apartment_id" value="<?= old('apartment_id', $tenant['apartment_id']) ?>" required>
    <div class="form-group">
        <label for="tenant_name">Tenant Name</label>
        <input type="text" class="form-control" id="tenant_name" name="tenant_name" value="<?= old('tenant_name', $tenant['tenant_name']) ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" required><?= old('address', $tenant['address']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= old('contact_number', $tenant['contact_number']) ?>" required>
    </div>

    <div class="form-group">
        <label for="from_date">From Date</label>
        <input type="date" class="form-control" id="from_date" name="from_date" value="<?= old('from_date', $tenant['from_date']) ?>">
    </div>

    <div class="form-group">
        <label for="to_date">To Date</label>
        <input type="date" class="form-control" id="to_date" name="to_date" value="<?= old('to_date', $tenant['to_date']) ?>">
    </div>

    <div class="form-group">
        <label for="remarks">Remarks</label>
        <textarea class="form-control" id="remarks" name="remarks"><?= old('remarks', $tenant['remarks']) ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Update Tenant</button>
        <a href="<?= base_url('/tenants') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?= $this->endSection() ?>