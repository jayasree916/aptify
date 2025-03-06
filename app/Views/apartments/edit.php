<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Block</h1>

<form method="post" action="<?= site_url('apartments/edit/' . $apartment['id']) ?>">
<div class="form-group">
        <label for="block">Block</label>
        <select class="form-control" id="block" name="block" required>
            <option value="">-- Select Block --</option>
            <?php foreach ($blocks as $block): ?>
                <option value="<?= $block['id'] ?>" <?= old('block_id', $block['id']) == $apartment['block_id'] ? 'selected' : '' ?>>
                    <?= $block['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Apartment No</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $apartment['name'] ?>" required>
    </div>
    <div class="form-group">
        <label for="apartment_type">Type</label>
        <select class="form-control" id="apartment_type" name="apartment_type" required>
            <option value="">-- Select Apartment Type --</option>
            <?php foreach ($apartmentTypes as $apartmentType): ?>
                <option value="<?= $apartmentType['id'] ?>" <?= old('apartment_id', $apartment['apartment_type_id']) == $apartmentType['id'] ? 'selected' : '' ?>>
                    <?= $apartmentType['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= $apartment['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="parking_type">Parking Area</label>
        <select class="form-control" id="parking_type" name="parking_type" required>
            <option value="">-- Select Parking Area --</option>
            <?php foreach ($parkingTypes as $parkingType): ?>
                <option value="<?= $parkingType['id'] ?>" <?= $apartment['parking_type_id'] == $parkingType['id'] ? 'selected' : '' ?>>
                    <?= $parkingType['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
    </form>

<?= $this->endSection() ?>