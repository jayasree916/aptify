<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Contact Us</h1>
<p>This is the Contact Us page from the content folder.</p>
<form method="post" action="<?= base_url('/send-message') ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <br><br>
    <button type="submit">Send</button>
</form>
<?= $this->endSection() ?>