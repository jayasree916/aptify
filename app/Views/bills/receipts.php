<h1 class="text-center">Paid Bills</h1>
<table class="table table-bordered mt-3">
    <tbody>
        <?php foreach ($bills as $bill): ?>
            <!-- Bill Header -->
            <tr class="table-primary text-center">
                <th colspan="6">Bill Summary</th>
            </tr>
            <tr>
                <th>Bill No:</th>
                <td><?= esc($bill['bill_no']) ?></td>
                <th>Year:</th>
                <td><?= esc($bill['year']) ?></td>
                <th>Month:</th>
                <td><?= esc($bill['month']) ?></td>
            </tr>
            <tr>
                <th>Bill Date:</th>
                <td><?= esc(date('d/m/Y', strtotime($bill['issued_date']))) ?></td>
                <th>Due Date:</th>
                <td class="text-danger"><strong><?= esc(date('d/m/Y', strtotime($bill['due_date']))) ?></strong></td>
                <th>Payment Completed:</th>
                <td class="text-success"><strong><?= esc(date('d/m/Y h:m:s A', strtotime($bill['paid_at']))) ?></strong></td>
            </tr>

            <!-- Itemized Bill -->
            <tr class="table-secondary text-center">
                <th colspan="4">Item</th>
                <th colspan="2">Amount (₹)</th>
            </tr>
            <?php foreach ($bill['items'] as $item): ?>
                <tr>
                    <td colspan="4"><?= esc($item['item_name']) ?></td>
                    <td colspan="2" class="text-end"><?= esc(number_format($item['amount'], 2)) ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Total Amount -->
            <tr class="table-warning">
                <th colspan="4" class="text-end">Total Amount:</th>
                <th colspan="2" class="text-end"><strong><?= esc(number_format($bill['amount'], 2)) ?></strong></th>
            </tr>
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>