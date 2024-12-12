<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Billing Type</h1>

<form action="<?= base_url('/billing-types/update/' . $billingType['id']) ?>" method="post">
    <div class="mb-3">
        <label for="type_name" class="form-label">Billing Type Name</label>
        <input type="text" class="form-control" id="billing_type" name="billing_type" value="<?= esc($billingType['billing_type']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= esc($billingType['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" class="form-control" id="default_charge" name="default_charge" value="<?= esc($billingType['default_charge']) ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= base_url('/billing-types') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>