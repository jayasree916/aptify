<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Owners</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/owners/add') ?>" class="btn btn-primary">Add New Owner</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Apartment No</th>
            <th>Owner Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($owners as $owner): ?>
            <tr>
                <td><?= esc($owner['apartment_no']) ?></td>
                <td><?= esc($owner['owner_name']) ?></td>
                <td><?= esc($owner['address']) ?></td>
                <td><?= esc($owner['mobile_no']) ?></td>
                <td><?= esc($owner['email']) ?></td>
                <td>
                    <a href="<?= base_url('/owners/owner-details/' . $owner['apartment_id']) ?>" class="btn btn-info">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>