<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Generate Monthly Bills</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/billing/payment') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="billingType" class="form-label">Billing Types</label>
        <select class="form-select" id="billingType" name="billing_type" required>
            <option value="" disabled selected>Select Billing Types</option>
            <?php foreach ($billing_types as $billing_type) : ?>
                <option value="<?= $billing_type['id']; ?>"><?= $billing_type['mode']; ?></option>
            <?php endforeach; ?>
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
    <div class="form-group">
        <label for="paymentMode" class="form-label">Payment Method</label>
        <select class="form-select" id="paymentMode" name="payment_mode" required>
            <option value="" disabled selected>Select Payment Method</option>
            <?php foreach ($payment_modes as $payment_mode) : ?>
                <option value="<?= $payment_mode['id']; ?>"><?= $payment_mode['mode']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="paymentAmount" class="form-label">Amount</label>
        <input type="number" class="form-control" id="paymentAmount" name="amount" required>
    </div>
    <div class="form-group">
        <label for="dateOfPayment" class="form-label">Date of Payment</label>
        <input type="date" class="form-control" id="dateOfPayment" name="date_of_payment" required>
    </div>
    <div class="form-group">
        <label for="paidBy" class="form-label">Paid To</label>
        <input type="text" class="form-control" id="paidBy" name="paid_by" placeholder="Enter payer's name" required>
    </div>
    <div class="form-group">
        <label for="narration" class="form-label">Narration</label>
        <textarea class="form-control" id="narration" name="narration" rows="3" placeholder="Enter narration"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Pay Now</button>
</form>

<?= $this->endSection() ?>