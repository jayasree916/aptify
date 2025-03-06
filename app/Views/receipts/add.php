<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Receipts</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/receipts/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="paymentMode" class="form-label">Item</label>
        <select class="form-select" id="billType" name="bill_type" required>
            <option value="" disabled selected>Select Item</option>
            <?php foreach ($bill_types as $bill_type) : ?>
                <option value="<?= $bill_type['id']; ?>"><?= $bill_type['billing_type']; ?></option>
            <?php endforeach; ?>
        </select>
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
        <label for="paidBy" class="form-label">Paid By</label>
        <input type="text" class="form-control" id="paidBy" name="paid_by" placeholder="Enter Payer's name" required>
    </div>
    <div class="form-group">
        <label for="narration" class="form-label">Narration</label>
        <textarea class="form-control" id="narration" name="narration" rows="3" placeholder="Enter narration"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>

<?= $this->endSection() ?>