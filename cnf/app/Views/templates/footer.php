<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-brand mb-3">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="PT Chakra Naga Furniture" height="50">
                    <span class="brand-name">Chakra Naga Furniture</span>
                </div>
                <p><?= lang('site_lang.footer_about') ?></p>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5 class="footer-heading"><?= lang('site_lang.footer_quicklinks') ?></h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>"><?= lang('site_lang.nav_home') ?></a></li>
                    <li><a href="#about"><?= lang('site_lang.nav_about') ?></a></li>
                    <li><a href="#products"><?= lang('site_lang.nav_products') ?></a></li>
                    <li><a href="<?= base_url('career') ?>"><?= lang('site_lang.nav_career') ?></a></li>
                    <li><a href="#contact"><?= lang('site_lang.nav_contact') ?></a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="footer-heading"><?= lang('site_lang.nav_products') ?></h5>
                <ul class="list-unstyled">
                    <li><a href="#upholstery"><?= lang('site_lang.nav_upholstery') ?></a></li>
                    <li><a href="#furniture"><?= lang('site_lang.nav_furniture') ?></a></li>
                    <li><a href="#gallery"><?= lang('site_lang.nav_gallery') ?></a></li>
                </ul>
            </div>
            
            <div class="col-lg-3">
                <h5 class="footer-heading"><?= lang('site_lang.footer_contact') ?></h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> <?= lang('site_lang.footer_address') ?></li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> <?= lang('site_lang.footer_phone') ?></li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> <?= lang('site_lang.footer_email') ?></li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0"><?= lang('site_lang.footer_copyright') ?></p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> for PT Chakra Naga Furniture</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

</body>
</html>