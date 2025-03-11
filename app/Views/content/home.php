<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Application') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php if (!session()->get('hide_sidebar')): ?>
                <?= $this->include('layout/sidebar') ?>
            <?php endif; ?>
            <!-- Main Content -->
            <div class="col-md-9 col-lg-9 col-sm-12">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
        <!-- </main> -->
        <!-- <header>
    <nav>
        <ul>
            <li><a href="<?= base_url('/') ?>">Home</a></li>
            <li><a href="<?= base_url('/about') ?>">About</a></li>
            <li><a href="<?= base_url('/login') ?>">Login</a></li>
            <li><a href="<?= base_url('/contact') ?>">Contact</a></li>
        </ul>
    </nav>
</header> -->
        <!-- Header -->
        <header class="bg-primary text-white py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <h1 class="h3">Aptify</h1>
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-white" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="btn btn-warning text-dark" href="/login">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container text-primary">
                <h2 class="display-4">Welcome to Aptify</h2>
                <p class="lead">Manage your apartment with ease and efficiency</p>
                <a href="#features" class="btn btn-warning btn-lg">Explore Features</a>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4">Features</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Resident Management</h5>
                                <p class="card-text">Track and manage all residents effortlessly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Apartment Details</h5>
                                <p class="card-text">Access apartment details and manage records in one place.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Payment Tracking</h5>
                                <p class="card-text">Keep track of payments and dues efficiently.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">Services</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-cogs fa-3x text-secondary mb-3"></i>
                                <h5 class="card-title">Maintenance Requests</h5>
                                <p class="card-text">Easily log and track maintenance requests.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope fa-3x text-secondary mb-3"></i>
                                <h5 class="card-title">Communication</h5>
                                <p class="card-text">Facilitate effective communication among residents.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-check fa-3x text-secondary mb-3"></i>
                                <h5 class="card-title">Event Management</h5>
                                <p class="card-text">Organize and manage community events seamlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2024 Aptify. All rights reserved.</p>
            <p>Follow us on
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </p>
        </div>
    </footer>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>