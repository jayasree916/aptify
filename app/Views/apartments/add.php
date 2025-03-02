<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Add Block</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


    <form method="post" action="<?= site_url('apartments/add') ?>">
    <div class="form-group">
        <label for="block">Block</label>
        <select class="form-control" id="block" name="block" required>
            <option value="">-- Select Block --</option>
            <?php foreach ($blocks as $block): ?>
                <option value="<?= $block['id'] ?>" <?= old('block') == $block['id'] ? 'selected' : '' ?>>
                    <?= $block['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Apartment No</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
    </div>
    <div class="form-group">
        <label for="apartment_type">Type</label>
        <select class="form-control" id="apartment_type" name="apartment_type" required>
            <option value="">-- Select Apartment Type --</option>
            <?php foreach ($apartmentTypes as $apartmentType): ?>
                <option value="<?= $apartmentType['id'] ?>" <?= old('apartmentType') == $apartmentType['id'] ? 'selected' : '' ?>>
                    <?= $apartmentType['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
    </div>
    <div class="form-group">
        <label for="parking_type">Parking Area</label>
        <select class="form-control" id="parking_type" name="parking_type" required>
            <option value="">-- Select Parking Area --</option>
            <?php foreach ($parkingTypes as $parkingType): ?>
                <option value="<?= $parkingType['id'] ?>" <?= old('parkingType') == $parkingType['id'] ? 'selected' : '' ?>>
                    <?= $parkingType['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
    </form>

<?= $this->endSection() ?>