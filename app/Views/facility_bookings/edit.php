<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Facility</h1>

<form method="post" action="<?= site_url('facilities/edit/' . $facility['id']) ?>">
    <div class="form-group">
        <label for="name">Facility</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $facility['name'] ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= $facility['description'] ?></textarea>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
    </form>

<?= $this->endSection() ?>