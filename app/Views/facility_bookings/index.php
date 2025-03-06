<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Requests</h2>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Apartment</th>
            <th>Facility</th>
            <th>Booking Date</th>
            <th>Time from</th>
            <th>Time to</th>
            <th>Applied by</th>
            <th>Actions</th>
        </tr>
        </thead>
    <tbody>
    <?php $slno = 0; ?>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= ++$slno; ?></td>
                <td><?= $request['apartment'] ?></td>
                <td><?= $request['facility'] ?></td>
                <td><?= date('d/m/Y', strtotime($request['booking_date'])) ?></td>
                <td><?= date('h:i A', strtotime($request['time_from'])) ?></td>
                <td><?= date('h:i A', strtotime($request['time_to'])) ?></td>
                <td><?= $request['applied_by'] ?></td>
                <td>
                <a href="<?= site_url('facility_bookings/approve/' . $request['id']) ?>"  class="btn btn-success">Approve</a>
                <a href="<?= site_url('facility_bookings/reject/' . $request['id']) ?>"  class="btn btn-danger">Reject</a>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Bookings</h2>
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Apartment</th>
            <th>Facility</th>
            <th>Booking Date</th>
            <th>Time from</th>
            <th>Time to</th>
            <th>Applied by</th>
            <th>Status</th>
        </tr>
        </thead>
    <tbody>
    <?php $slno = 0; ?>
        <?php foreach ($bookings as $booking): ?>
            <?php
        // Apply color based on status
        $rowClass = ($booking['status'] == 'approved') ? 'table-success' : (($booking['status'] == 'rejected') ? 'table-danger' : '');
    ?>
            <tr class="<?= $rowClass; ?>">
                <td><?= ++$slno; ?></td>
                <td><?= $booking['apartment'] ?></td>
                <td><?= $booking['facility'] ?></td>
                <td><?= date('d/m/Y', strtotime($booking['booking_date'])) ?></td>
                <td><?= date('h:i A', strtotime($booking['time_from'])) ?></td>
                <td><?= date('h:i A', strtotime($booking['time_to'])) ?></td>
                <td><?= $booking['applied_by'] ?></td>
                <td><?= $booking['status'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>