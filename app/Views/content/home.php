<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<header>
    <nav>
        <ul>
            <li><a href="<?= base_url('/') ?>">Home</a></li>
            <li><a href="<?= base_url('/about') ?>">About</a></li>
            <li><a href="<?= base_url('/login') ?>">Login</a></li>
            <li><a href="<?= base_url('/contact') ?>">Contact</a></li>
        </ul>
    </nav>
</header>
<h1>Welcome to Aptify</h1>
<p>This is the home page content.</p>
<?= $this->endSection() ?>