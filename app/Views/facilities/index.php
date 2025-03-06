<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Facilities</h2>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <a href="<?= site_url('facilities/add') ?>" class="btn btn-primary">Add New Facility</a>
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Facility</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
    <tbody>
    <?php $slno = 0; ?>
        <?php foreach ($facilities as $facility): ?>
            <tr>
                <td><?= ++$slno; ?></td>
                <td><?= $facility['name'] ?></td>
                <td><?= $facility['description'] ?></td>
                <td>
                    <a href="<?= site_url('facilities/edit/' . $facility['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= site_url('facilities/delete/' . $facility['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>