<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<ul class="nav nav-tabs" id="apartmentTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= ($activeTab === 'apartment') ? 'active' : '' ?>" href="<?= site_url('apartment/apartment-details/' . $apartment['id'] . '?tab=apartment') ?>" role="tab">Apartment</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= ($activeTab === 'tenants') ? 'active' : '' ?>" href="<?= site_url('apartment/apartment-details/' . $apartment['id'] . '?tab=tenants') ?>" role="tab">Tenants</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= ($activeTab === 'bills') ? 'active' : '' ?>" href="<?= site_url('apartment/apartment-details/' . $apartment['id'] . '?tab=bills') ?>" role="tab">Generated Bills</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= ($activeTab === 'payments') ? 'active' : '' ?>" href="<?= site_url('apartment/apartment-details/' . $apartment['id'] . '?tab=payments') ?>" role="tab">Payment Status</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= ($activeTab === 'advance') ? 'active' : '' ?>" href="<?= site_url('apartment/apartment-details/' . $apartment['id'] . '?tab=advance') ?>" role="tab">Advance Payment</a>
    </li>
</ul>

<div class="tab-content mt-3" id="apartmentTabContent">
    <?= $this->include($tabView) ?>
</div>

<?= $this->endSection() ?>