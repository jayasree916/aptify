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
                        data-bill-no="<?= esc($bill['bill_no']) ?>"
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
                    <!-- Use a placeholder in the title -->
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details for Bill No: <span id="modalBillNoPlaceholder"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="billId" name="bill_id" value="">
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod" name="payment_method" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <?php foreach ($payment_modes as $payment_mode) : ?>
                                <option value="<?= $payment_mode['id']; ?>"><?= $payment_mode['mode']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" name="amount" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dateOfPayment" class="form-label">Date of Payment</label>
                        <input type="date" class="form-control" id="dateOfPayment" name="date_of_payment" required>
                    </div>
                    <div class="mb-3">
                        <label for="paidBy" class="form-label">Paid By</label>
                        <input type="text" class="form-control" id="paidBy" name="paid_by" placeholder="Enter payer's name" required>
                    </div>
                    <div class="mb-3">
                        <label for="narration" class="form-label">Narration</label>
                        <textarea class="form-control" id="narration" name="narration" rows="3" placeholder="Enter narration"></textarea>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('paymentModal');
        const billNoPlaceholder = document.getElementById('modalBillNoPlaceholder');
        const billIdInput = document.getElementById('billId');
        const paymentAmountInput = document.getElementById('paymentAmount');

        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const billNo = button.getAttribute('data-bill-no');
            const billId = button.getAttribute('data-id');
            const amount = button.getAttribute('data-amount');

            // Populate the modal content
            billNoPlaceholder.textContent = billNo;
            billIdInput.value = billId;
            paymentAmountInput.value = amount;
        });
    });
</script>