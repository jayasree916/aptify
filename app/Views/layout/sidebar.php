<div class="col-md-3 col-lg-3 bg-light sidebar-wrapper">
    <div class="card dashboard-sidebar">
        <div class="card-header bg-primary text-white">
            <h4>Aptify</h4>
        </div>
        <div class="list-group list-group-flush">
            <?php foreach ($menuItems as $menu) : ?>
                <a href="<?= base_url($menu['url']) ?>" class="list-group-item list-group-item-action"><?= esc($menu['name']) ?></a>
            <?php endforeach; ?>
            <a href="<?= base_url('/logout') ?>" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</div>