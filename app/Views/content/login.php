<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Login</h1>
<form method="post" action="<?= base_url('/authenticate') ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <button type="submit">Login</button>
</form>
<?= $this->endSection() ?>