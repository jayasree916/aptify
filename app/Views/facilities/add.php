<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Add Facility</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


    <form method="post" action="<?= site_url('facilities/add') ?>">
    <div class="form-group">
        <label for="name">Facility</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
    </form>

<?= $this->endSection() ?>