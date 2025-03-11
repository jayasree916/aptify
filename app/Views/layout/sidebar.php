<div class="col-md-3 col-lg-3 bg-light sidebar-wrapper">
    <div class="card dashboard-sidebar">
        <div class="card-header bg-primary text-white">
            <h4>Aptify</h4>
        </div>
        <div class="list-group list-group-flush">
            <?php foreach ($menuItems as $menu) : ?>
                <?php if (!empty($menu['submenus'])) : ?>
                    <!-- Parent Menu with Submenus (Collapsible) -->
                    <a href="#submenu-<?= $menu['id'] ?>" class="list-group-item list-group-item-action" 
                       data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenu-<?= $menu['id'] ?>">
                        <?= esc($menu['name']) ?> <span class="float-end">▼</span>
                    </a>
                    <div class="collapse" id="submenu-<?= $menu['id'] ?>">
                        <div class="list-group">
                            <?php foreach ($menu['submenus'] as $submenu) : ?>
                                <a href="<?= base_url($submenu['url']) ?>" class="list-group-item list-group-item-action ps-4">
                                    <?= esc($submenu['name']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Standalone Menu Item -->
                    <a href="<?= base_url($menu['url']) ?>" class="list-group-item list-group-item-action">
                        <?= esc($menu['name']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
