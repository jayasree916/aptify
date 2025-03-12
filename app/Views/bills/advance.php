<h1>Advance Payment</h1>
<?php
if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('/billing/advance-payment') ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" class="form-control" id="apartmentId" name="apartment_id" value="<?= $apartment['apartment_id']; ?>">
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
        <input type="text" class="form-control" id="paidBy" name="paid_by" placeholder="Enter payer's name" required>
    </div>
    <div class="form-group">
        <label for="narration" class="form-label">Narration</label>
        <textarea class="form-control" id="narration" name="narration" rows="3" placeholder="Enter narration"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Pay Now</button>
</form>