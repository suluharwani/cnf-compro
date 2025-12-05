<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-brand mb-3">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="PT Chakra Naga Furniture" height="50">
                    <span class="brand-name"><?= $companyInfo['company_name'] ?? 'Chakra Naga Furniture' ?></span>
                </div>
                <p><?= $companyInfo['company_description'] ?? 'Premium furniture manufacturer specializing in upholstery and wooden furniture from Jepara, Indonesia.' ?></p>
                
                <div class="social-links mt-4">
                    <a href="<?= $companyInfo['facebook_url'] ?? '#' ?>" class="social-icon" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?= $companyInfo['instagram_url'] ?? '#' ?>" class="social-icon" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="<?= $companyInfo['linkedin_url'] ?? '#' ?>" class="social-icon" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="<?= $companyInfo['whatsapp_url'] ?? 'https://wa.me/62291591741' ?>" class="social-icon" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="<?= $companyInfo['youtube_url'] ?? '#' ?>" class="social-icon" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5 class="footer-heading"><?= $translations['footer_links'] ?? 'Quick Links' ?></h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>"><?= $translations['nav_home'] ?? 'Home' ?></a></li>
                    <li><a href="#about"><?= $translations['nav_about'] ?? 'About Us' ?></a></li>
                    <li><a href="#products"><?= $translations['nav_products'] ?? 'Products' ?></a></li>
                    <li><a href="<?= base_url('career') ?>"><?= $translations['nav_career'] ?? 'Career' ?></a></li>
                    <li><a href="#contact"><?= $translations['nav_contact'] ?? 'Contact' ?></a></li>
                    <li><a href="<?= base_url('download-catalog') ?>"><?= $translations['download_catalog'] ?? 'Download Catalog' ?></a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="footer-heading"><?= $translations['footer_categories'] ?? 'Product Categories' ?></h5>
                <ul class="list-unstyled">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <li><a href="<?= base_url('products/' . $category['slug']) ?>"><?= $category['name'] ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="<?= base_url('products') ?>"><?= $translations['upholstery'] ?? 'Upholstery' ?></a></li>
                        <li><a href="<?= base_url('products') ?>"><?= $translations['wooden_furniture'] ?? 'Wooden Furniture' ?></a></li>
                        <li><a href="<?= base_url('products') ?>"><?= $translations['custom_design'] ?? 'Custom Design' ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="col-lg-3">
                <h5 class="footer-heading"><?= $translations['footer_contact'] ?? 'Contact Info' ?></h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span><?= $companyInfo['company_address'] ?? 'Dusun 1, Suwawal, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452' ?></span>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <a href="tel:<?= $companyInfo['company_phone'] ?? '+62291591741' ?>" class="text-decoration-none">
                            <?= $companyInfo['company_phone'] ?? '+62 291 591741' ?>
                        </a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <a href="mailto:<?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?>" class="text-decoration-none">
                            <?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?>
                        </a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        <span><?= $companyInfo['working_hours'] ?? 'Monday - Friday: 8:00 AM - 5:00 PM' ?></span>
                    </li>
                    <li>
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                        <span><?= $companyInfo['working_days'] ?? 'Monday to Saturday' ?></span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Newsletter Subscription -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="newsletter-section text-center">
                    <h5 class="mb-3"><?= $translations['footer_newsletter'] ?? 'Subscribe to Our Newsletter' ?></h5>
                    <p class="mb-4 small"><?= $translations['newsletter_description'] ?? 'Get updates on new products, exclusive offers, and furniture design trends.' ?></p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="<?= $translations['newsletter_placeholder'] ?? 'Enter your email address' ?>" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane me-2"></i> <?= $translations['subscribe_button'] ?? 'Subscribe' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">
                    <?= $companyInfo['footer_copyright'] ?? '© ' . date('Y') . ' PT Chakra Naga Furniture. All rights reserved.' ?>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">
                    <?= $companyInfo['footer_developed_by'] ?? 'Designed with <i class="fas fa-heart text-danger"></i> for PT Chakra Naga Furniture' ?>
                </p>
            </div>
        </div>
        
        <!-- Back to Top Button -->
        <div class="text-center mt-4">
            <a href="#" class="back-to-top">
                <i class="fas fa-arrow-up me-2"></i> <?= $translations['back_to_top'] ?? 'Back to Top' ?>
            </a>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

</body>
</html>