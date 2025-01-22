</main>
<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p>&copy; 2024 Aptify. All rights reserved.</p>
        <p>Follow us on
            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        </p>
    </div>
</footer>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const paymentModal = document.getElementById('paymentModal');
        const billIdInput = document.getElementById('billId');
        const amountInput = document.getElementById('paymentAmount');

        document.querySelectorAll('.pay-now-btn').forEach(button => {
            button.addEventListener('click', () => {
                const billId = button.getAttribute('data-id');
                const amount = button.getAttribute('data-amount');

                billIdInput.value = billId;
                amountInput.value = amount;
            });
        });

        // Handle form submission via AJAX (optional)
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(paymentForm);
            try {
                const response = await fetch('<?= base_url("/billing/process-payment") ?>', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.status === 'success') {
                    alert('Payment successful!');
                    location.reload();
                } else {
                    alert('Payment failed: ' + result.message);
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
            }
        });
    });
</script>

</body>

</html>