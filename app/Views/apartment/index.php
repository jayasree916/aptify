<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Apartment Listings</h1>

<a href="<?= base_url('/apartment/add') ?>" class="btn btn-primary">Add New Apartment</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Apartment No</th>
            <th>Owner Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Block</th>
            <th>Type</th>
            <th>Occupancy</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($apartments as $apartment): ?>
            <tr>
                <td><?= esc($apartment['apartment_no']) ?></td>
                <td><?= esc($apartment['owner_name']) ?></td>
                <td><?= esc($apartment['address']) ?></td>
                <td><?= esc($apartment['contact_no']) ?></td>
                <td><?= esc($apartment['block']) ?></td>
                <td><?= esc($apartment['type']) ?></td>
                <td><?= esc($apartment['occupancy']) ?></td>
                <td>
                    <a href="<?= base_url('/apartment/edit/' . $apartment['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/apartment/delete/' . $apartment['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>