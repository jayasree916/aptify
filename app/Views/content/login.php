<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Application') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
</head>

<body>
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
    <div class="login-container">
        <div class="login-background">
            <img src="<?= base_url('assets/images/login-bg.jpg') ?>" alt="Background Image">
        </div>
        <div class="login-form-container">
            <header>
                <h1>Welcome Back</h1>
                <p>Sign in to continue to your dashboard.</p>
            </header>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?= site_url('/authenticate') ?>" method="post" class="login-form">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
            <!-- <footer>
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </footer> -->
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Aptify. All rights reserved.</p>
        <p>Follow us on
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </p>
    </footer>
</body>

</html>