<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h3>Welcome to the Dashboard</h3>
                    <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>
                </div>
                <div class="card-body">
                    <!-- Dashboard Content (Aligned and Full Width with Counts) -->
                    <div class="row">
                        <?php
                        $sections = [
                            ['title' => 'Apartments', 'desc' => 'View apartments', 'url' => '/owners', 'color' => 'primary', 'count' => $apartment_count],
                            ['title' => 'Bookings', 'desc' => 'View bookings', 'url' => '/facility_bookings', 'color' => 'success', 'count' => $booking_count],
                            ['title' => 'Users', 'desc' => 'Manage users', 'url' => '/users', 'color' => 'warning', 'count' => $user_count],
                            ['title' => 'Billing', 'desc' => 'View generated bills', 'url' => '/billing', 'color' => 'info', 'count' => $billing_count],
                            ['title' => 'Expenditure', 'desc' => 'View expenditure', 'url' => '/payments', 'color' => 'danger', 'count' => $payment_received],
                            ['title' => 'Maintenance', 'desc' => 'maintenance request', 'url' => '/maintenance', 'color' => 'dark', 'count' => $maintenance_requests]
                        ];
                        ?>

                        <?php foreach ($sections as $section): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <a href="<?= base_url($section['url']) ?>" class="card dashboard-card text-white bg-<?= $section['color'] ?> shadow-sm d-block text-decoration-none">
                                    <div class="card-body text-center py-4">
                                        <h4 class="mb-2"> <?= $section['title'] ?> </h4>
                                        <h5 class="fw-bold"> <?= $section['count'] ?> </h5>
                                        <p class="mb-0"> <?= $section['desc'] ?> </p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <?= esc($user['name']) ?></p>
                <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                <p><strong>Contact No:</strong> <?= esc($user['contact_no']) ?></p>
                <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
                <p><strong>Created At:</strong> <?= esc($user['created_at']) ?></p>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('/profile/edit') ?>" class="btn btn-warning">Edit Profile</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Additional CSS for styling -->
<style>
    .dashboard-card:hover {
        transform: scale(1.05);
        transition: 0.3s;
    }

    .fa-user-circle:hover {
        cursor: pointer;
        opacity: 0.8;
    }

    .dashboard-card {
        text-decoration: none !important;
    }
</style>

<?= $this->endSection() ?>