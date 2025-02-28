<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Blocks</h2>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <a href="<?= site_url('blocks/add') ?>" class="btn btn-primary">Add New Block</a>
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
    <tbody>
        <?php foreach ($blocks as $block): ?>
            <tr>
                <td><?= $block['id'] ?></td>
                <td><?= $block['name'] ?></td>
                <td><?= $block['description'] ?></td>
                <td>
                    <a href="<?= site_url('blocks/edit/' . $block['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= site_url('blocks/delete/' . $block['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>