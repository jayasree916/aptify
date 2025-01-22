<h1>Pending Bills</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Year</th>
            <th>Month</th>
            <th>Amount</th>
            <th>Bill Date</th>
            <th>Due Date</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bills as $bill): ?>
            <tr>
                <td><?= esc($bill['bill_no']) ?></td>
                <td><?= esc($bill['year']) ?></td>
                <td><?= esc($bill['month']) ?></td>
                <td><?= esc(number_format($bill['amount'], 2)) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($bill['issued_date']))) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($bill['due_date']))) ?></td>
                <td><button
                        type="button"
                        class="btn btn-primary pay-now-btn"
                        data-id="<?= esc($bill['id']) ?>"
                        data-amount="<?= esc($bill['amount']) ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#paymentModal">
                        Pay Now
                    </button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="paymentForm" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="billId" name="bill_id" value="">
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod" name="payment_method" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="net_banking">Net Banking</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" name="amount" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pay</button>
                </div>
            </form>
        </div>
    </div>
</div>