<h1>Tenants</h1>
<?php if (session()->getFlashdata('status') && session()->getFlashdata('message')): ?>
    <div class="alert alert-<?= session()->getFlashdata('status') === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<a href="<?= base_url('/tenants/add?apartment_id=' . $apartment['apartment_id']) ?>" class="btn btn-primary">Add New Tenant</a>


<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Tenant Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Remarks</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tenants as $tenant): ?>
            <tr>
                <td><?= esc($tenant['tenant_name']) ?></td>
                <td><?= esc($tenant['address']) ?></td>
                <td><?= esc($tenant['contact_number']) ?></td>
                <td><?= esc($tenant['from_date']) ?></td>
                <td><?= esc($tenant['to_date']) ?></td>
                <td><?= esc($tenant['remarks']) ?></td>
                <td>
                    <a href="<?= base_url('/tenants/edit/' . $tenant['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/tenants/delete/' . $tenant['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>