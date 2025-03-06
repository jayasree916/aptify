<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Bill</h1>

<form action="<?= base_url('/billing/update/' . $bill['id']) ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" class="form-control" id="year" name="year" value="<?= esc($bill['year']) ?>" required min="2000" max="<?= date('Y') ?>">
    </div>

    <div class="form-group">
        <label for="month">Month</label>
        <select class="form-control" id="month" name="month" required>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= $bill['month'] == $i ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $i, 10)) ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Billing Types</label>
        <div class="form-check">
            <?php foreach ($billingTypes as $type): ?>
                <input class="form-check-input" type="checkbox" id="billing_type_<?= $type['id'] ?>" name="billing_types[]" value="<?= $type['id'] ?>"
                    <?= in_array($type['id'], $selectedBillingTypes) ? 'checked' : '' ?>>
                <label class="form-check-label" for="billing_type_<?= $type['id'] ?>">
                    <?= esc($type['billing_type']) ?> (<?= esc(number_format($type['default_charge'], 2)) ?>)
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Update Bill</button>
</form>

<?= $this->endSection() ?>