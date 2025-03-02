<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Apartment</h1>

<form action="<?= base_url('/apartment/edit/' . $apartment['id']) ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT"> <!-- Method spoofing for update -->

    <div class="form-group">
        <label for="apartment_no">Apartment No</label>
        <input type="text" class="form-control" id="apartment_no" name="apartment_no" value="<?= esc($apartment['apartment_no']) ?>" required>
    </div>

    <div class="form-group">
        <label for="owner_name">Owner Name</label>
        <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?= esc($apartment['owner_name']) ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= esc($apartment['address']) ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Contact Number</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?= esc($apartment['contact_no']) ?>" required>
    </div>

    <div class="form-group">
        <label for="block">Block</label>
        <input type="text" class="form-control" id="block" name="block" value="<?= esc($apartment['block']) ?>" required>
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= esc($apartment['type']) ?>" required>
    </div>

    <div class="form-group">
        <label for="occupancy">Occupancy</label>
        <select class="form-control" id="occupancy" name="occupancy" required>
            <option value="vacant" <?= $apartment['occupancy'] == 'vacant' ? 'selected' : '' ?>>Vacant</option>
            <option value="occupied" <?= $apartment['occupancy'] == 'occupied' ? 'selected' : '' ?>>Occupied</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Apartment</button>
    </div>
</form>

<?= $this->endSection() ?>