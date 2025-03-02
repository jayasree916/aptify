<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Apartments</h2>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <a href="<?= site_url('apartments/add') ?>" class="btn btn-primary">Add New Apartment</a>
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Block</th>
            <th>Name</th>
            <th>Description</th>
            <th>Apartment Type</th>
            <th>Parking Type</th>
            <th>Actions</th>
        </tr>
        </thead>
    <tbody>
    <?php $slno = 0; ?>
        <?php foreach ($apartments as $apartment): ?>
            <tr>
                <td><?= ++$slno; ?></td>
                <td><?= $apartment['block_name'] ?></td>
                <td><?= $apartment['name'] ?></td>
                <td><?= $apartment['description'] ?></td>
                <td><?= $apartment['apartment_type_name'] ?></td>
                <td><?= $apartment['parking_type_name'] ?></td>
                <td>
                    <a href="<?= site_url('apartments/edit/' . $apartment['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= site_url('apartments/delete/' . $apartment['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>