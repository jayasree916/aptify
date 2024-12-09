<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Application') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
</head>

<body>

    <main class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?= $this->include('layout/sidebar') ?>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-9 col-sm-12">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    <!-- </main> -->