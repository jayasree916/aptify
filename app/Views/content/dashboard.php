<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3>Welcome to the Dashboard</h3>
                </div>
                <div class="card-body">
                    <!-- User Profile -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-fluid rounded-circle">
                        </div>
                        <div class="col-md-9">
                            <h4>User Profile</h4>
                            <p><strong>Name:</strong> <?= esc($user['name']) ?></p>
                            <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                            <p><strong>Contact No:</strong> <?= esc($user['contact_no']) ?></p>
                            <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
                            <p><strong>Created At:</strong> <?= esc($user['created_at']) ?></p>
                            <a href="<?= base_url('/profile/edit') ?>" class="btn btn-warning">Edit Profile</a>
                        </div>
                    </div>

                    <!-- Dashboard Content -->
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= base_url('/apartment') ?>" class="card dashboard-card text-white bg-primary mb-4">
                                <div class="card-body text-center">
                                    <h4>Apartments</h4>
                                    <p>Manage and view apartments</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('/tenants') ?>" class="card dashboard-card text-white bg-success mb-4">
                                <div class="card-body text-center">
                                    <h4>Tenants</h4>
                                    <p>Manage tenants</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('/users') ?>" class="card dashboard-card text-white bg-warning mb-4">
                                <div class="card-body text-center">
                                    <h4>Users</h4>
                                    <p>Manage users</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= base_url('/billing') ?>" class="card dashboard-card text-white bg-info mb-4">
                                <div class="card-body text-center">
                                    <h4>Billing</h4>
                                    <p>Generate and view billing information</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('/payments') ?>" class="card dashboard-card text-white bg-danger mb-4">
                                <div class="card-body text-center">
                                    <h4>Payments</h4>
                                    <p>View and manage payments</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('/maintenance') ?>" class="card dashboard-card text-white bg-dark mb-4">
                                <div class="card-body text-center">
                                    <h4>Maintenance</h4>
                                    <p>Manage apartment maintenance</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>