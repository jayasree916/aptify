<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Generate Monthly Bills</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/billing/generate-bill') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" class="form-control" id="year" name="year" required min="2000" max="<?= date('Y') ?>">
    </div>

    <div class="form-group">
        <label for="month">Month</label>
        <select class="form-control" id="month" name="month" required>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 10)) ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Billing Types</label>
        <?php foreach ($billingTypes as $type): ?>
            <div class="form-check"> <!-- Wrap each checkbox and label in a container -->
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="billing_type_<?= $type['id'] ?>"
                    name="billing_types[]"
                    value="<?= $type['id'] ?>">
                <label class="form-check-label" for="billing_type_<?= $type['id'] ?>">
                    <?= esc($type['billing_type']) ?> (<?= esc(number_format($type['default_charge'], 2)) ?>)
                </label>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-success">Generate Bills</button>
</form>

<?= $this->endSection() ?>