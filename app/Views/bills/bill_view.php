<h1>Pending Bills</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<table class="table table-bordered mt-3">
    <tbody>
        <?php foreach ($bills as $bill): ?>
            <!-- Bill Header -->
            <tr>
                <th colspan="5" class="text-center bg-primary text-white">Bill Summary</th>
            </tr>
            <tr>
                <th>Bill No:</th>
                <td><?= esc($bill['bill_no']) ?></td>
                <th>Year:</th>
                <td><?= esc($bill['year']) ?></td>
                <td rowspan="2" class="text-center">
                    <button type="button"
                        class="btn btn-primary pay-now-btn"
                        data-id="<?= esc($bill['id']) ?>"
                        data-amount="<?= esc($bill['amount']) ?>"
                        data-bill-no="<?= esc($bill['bill_no']) ?>"
                        data-apartment-id="<?= esc($bill['apartment_id']) ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#paymentModal">
                        Pay Now
                    </button>
                </td>
            </tr>
            <tr>
                <th>Month:</th>
                <td><?= esc($bill['month']) ?></td>
                <th>Bill Date:</th>
                <td><?= esc(date('d/m/Y', strtotime($bill['issued_date']))) ?></td>
            </tr>
            <tr>
                <th>Due Date:</th>
                <td colspan="4" class="text-danger"><strong><?= esc(date('d/m/Y', strtotime($bill['due_date']))) ?></strong></td>
            </tr>

            <!-- Itemized Bill -->
            <tr>
                <th colspan="3" class="text-center bg-secondary text-white">Item</th>
                <th colspan="2" class="text-center bg-secondary text-white">Amount</th>
            </tr>
            <?php foreach ($bill['items'] as $item): ?>
                <tr>
                    <td colspan="3"><?= esc($item['item_name']) ?></td>
                    <td colspan="2" class="text-end"><?= esc(number_format($item['amount'], 2)) ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Total Amount -->
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th colspan="2" class="text-end"><strong><?= esc(number_format($bill['amount'], 2)) ?></strong></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="paymentForm" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <!-- Use a placeholder in the title -->
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details for Bill No: <span id="modalBillNoPlaceholder"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="billId" name="bill_id" value="">
                    <input type="hidden" id="billNo" name="bill_no" value="">
                    <input type="hidden" id="apartmentId" name="apartment_id" value="">
                    <div class="mb-3">
                        <label for="paymentMode" class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMode" name="payment_mode" required>
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
        const billNoInput = document.getElementById('billNo');
        const paymentAmountInput = document.getElementById('paymentAmount');
        const apartmentIdInput = document.getElementById('apartmentId');

        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const billNo = button.getAttribute('data-bill-no');
            const billId = button.getAttribute('data-id');
            const amount = button.getAttribute('data-amount');
            const apartmentId = button.getAttribute('data-apartment-id');

            // Populate the modal content
            billNoPlaceholder.textContent = billNo;
            billIdInput.value = billId;
            billNoInput.value = billNo;
            paymentAmountInput.value = amount;
            apartmentIdInput.value = apartmentId;
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const paymentModal = document.getElementById('paymentModal');
        const billIdInput = document.getElementById('billId');
        const billNoInput = document.getElementById('billNo');
        const amountInput = document.getElementById('paymentAmount');
        const apartmentIdInput = document.getElementById('apartmentId');

        document.querySelectorAll('.pay-now-btn').forEach(button => {
            button.addEventListener('click', () => {
                const billId = button.getAttribute('data-id');
                const billNo = button.getAttribute('data-bill-no');
                const amount = button.getAttribute('data-amount');
                const apartmentId = button.getAttribute('data-apartment-id');

                billIdInput.value = billId;
                billNoInput.value = billNo;
                amountInput.value = amount;
                apartmentIdInput.value = apartmentId;
            });
        });

        // Handle form submission via AJAX (optional)
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(paymentForm);
            const csrfToken = document.querySelector('input[name="csrf_test_name"]').value; // Replace 'csrf_test_name' with your token name
            try {
                const response = await fetch('<?= base_url("/billing/process-payment") ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });
                const result = await response.json();
                console.log(result);
                if (result.status === 'success') {
                    alert('Payment successful!');
                    location.reload();
                } else {
                    alert('Payment failed: ' + result.message);
                }
            } catch (error) {
                alert('An error occurred. Please try again.' + error.message);
            }
        });
    });
</script>