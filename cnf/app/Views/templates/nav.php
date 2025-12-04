<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="PT Chakra Naga Furniture" height="60">
            <span class="brand-name">Chakra Naga Furniture</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="<?= base_url() ?>">
                        <i class="fas fa-home me-1"></i> <?= lang('site_lang.nav_home') ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        <i class="fas fa-info-circle me-1"></i> <?= lang('site_lang.nav_about') ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-couch me-1"></i> <?= lang('site_lang.nav_products') ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        <li><a class="dropdown-item" href="#upholstery"><?= lang('site_lang.nav_upholstery') ?></a></li>
                        <li><a class="dropdown-item" href="#furniture"><?= lang('site_lang.nav_furniture') ?></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">
                        <i class="fas fa-images me-1"></i> <?= lang('site_lang.nav_gallery') ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'career' ? 'active' : '' ?>" href="<?= base_url('career') ?>">
                        <i class="fas fa-briefcase me-1"></i> <?= lang('site_lang.nav_career') ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">
                        <i class="fas fa-envelope me-1"></i> <?= lang('site_lang.nav_contact') ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>