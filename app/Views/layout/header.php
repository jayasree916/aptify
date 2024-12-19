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

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background: url('https://source.unsplash.com/1920x1080/?apartment') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .features .card {
            transition: transform 0.3s;
        }

        .features .card:hover {
            transform: scale(1.05);
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
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