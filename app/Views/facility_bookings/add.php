<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Add Booking Request</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


    <form method="post" action="<?= site_url('facility_bookings/add') ?>">
    <div class="form-group">
        <label for="facility" class="form-label">Facility</label>
        <select class="form-select" id="facility" name="facility" required>
            <option value="" disabled selected>Select Facility</option>
            <?php foreach ($facilities as $facility) : ?>
                <option value="<?= $facility['id']; ?>"><?= $facility['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="booking_date" class="form-label">Date</label>
        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
    </div>
    <div class="form-group">
        <label for="time_from" class="form-label">Time From</label>
        <input type="time" class="form-control" id="time_from" name="time_from" required>
    </div>
    <div class="form-group">
        <label for="time_to" class="form-label">Time To</label>
        <input type="time" class="form-control" id="time_to" name="time_to" required>
    </div>
    <div class="form-group">
        <label for="description">Remarks</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
    </form>
    <h2>My Bookings</h2>
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Apartment</th>
            <th>Facility</th>
            <th>Booking Date</th>
            <th>Time from</th>
            <th>Time to</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
    <tbody>
    <?php $slno = 0; ?>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= ++$slno; ?></td>
                <td><?= $booking['apartment'] ?></td>
                <td><?= $booking['facility'] ?></td>
                <td><?= date('d/m/Y', strtotime($booking['booking_date'])) ?></td>
                <td><?= date('h:i A', strtotime($booking['time_from'])) ?></td>
                <td><?= date('h:i A', strtotime($booking['time_to'])) ?></td>
                <td><?= $booking['status'] ?></td>
                <td>
                    <?php if($booking['status'] == 'pending') : ?>
                    <a href="<?= site_url('facility_bookings/edit/' . $booking['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= site_url('facility_bookings/delete/' . $booking['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>