<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Edit Block</h1>

<form method="post" action="<?= site_url('blocks/edit/' . $block['id']) ?>">
<div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $block['name'] ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="description" name="description" required><?= $block['description'] ?></textarea>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
    </form>

<?= $this->endSection() ?>