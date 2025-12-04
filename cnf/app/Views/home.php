<?= $this->include('templates/header') ?>

<?= $this->include('templates/nav') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title"><?= $translations['hero_title'] ?? $companyInfo['hero_title'] ?? 'Premium Furniture Manufacturer' ?></h1>
                <h2 class="hero-subtitle"><?= $translations['hero_subtitle'] ?? $companyInfo['hero_subtitle'] ?? 'Crafting Excellence Since 2005' ?></h2>
                <p class="hero-description"><?= $translations['hero_description'] ?? $companyInfo['hero_description'] ?? 'Specializing in high-quality upholstery and wooden furniture from Jepara' ?></p>
                <div class="hero-buttons mt-4">
                    <a href="<?= base_url('download-catalog') ?>" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-download me-2"></i> <?= $translations['download_catalog'] ?? 'Download Catalog' ?>
                    </a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone-alt me-2"></i> <?= $translations['contact_us'] ?? 'Contact Us' ?>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if (!empty($featuredProducts[0]['image_url'])): ?>
                <div class="hero-image">
                    <img src="<?= $featuredProducts[0]['image_url'] ?>" 
                         alt="<?= $featuredProducts[0]['name'] ?? 'Featured Product' ?>" 
                         class="img-fluid rounded shadow">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<?php if (!empty($categories)): ?>
<section class="categories-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['product_categories'] ?? 'Product Categories' ?></h2>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
            <div class="col-md-3">
                <a href="<?= base_url('products/' . $category['slug']) ?>" class="category-card">
                    <div class="category-icon mb-3">
                        <i class="<?= $category['icon'] ?? 'fas fa-couch' ?> fa-3x"></i>
                    </div>
                    <h4><?= $category['name'] ?></h4>
                    <p class="small"><?= $category['description'] ?? '' ?></p>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Featured Products -->
<?php if (!empty($featuredProducts)): ?>
<section id="products" class="products-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['featured_products'] ?? 'Featured Products' ?></h2>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?= $product['image_url'] ?>" 
                             alt="<?= $product['name'] ?>" 
                             class="img-fluid">
                        <?php if ($product['is_new']): ?>
                        <span class="product-badge new"><?= $translations['new'] ?? 'New' ?></span>
                        <?php endif; ?>
                        <?php if ($product['is_bestseller']): ?>
                        <span class="product-badge bestseller"><?= $translations['bestseller'] ?? 'Bestseller' ?></span>
                        <?php endif; ?>
                        <?php if ($product['is_featured']): ?>
                        <span class="product-badge featured"><?= $translations['featured'] ?? 'Featured' ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info p-3">
                        <h5 class="product-title"><?= $product['name'] ?></h5>
                        <p class="product-category"><?= $product['category'] ?></p>
                        <p class="product-material small text-muted">
                            <i class="fas fa-cube me-1"></i> <?= $product['material'] ?? 'Premium Materials' ?>
                        </p>
                        <p class="product-desc small"><?= $product['short_description'] ?? '' ?></p>
                        <div class="product-actions mt-3">
                            <a href="<?= base_url('product/' . $product['product_code']) ?>" class="btn btn-outline-primary btn-sm">
                                <?= $translations['view_details'] ?? 'View Details' ?>
                            </a>
                            <a href="#contact" class="btn btn-primary btn-sm">
                                <i class="fas fa-envelope me-1"></i> <?= $translations['inquire'] ?? 'Inquire' ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">
                <?= $translations['view_all_products'] ?? 'View All Products' ?> <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Product Categories Detail -->
<section class="categories-detail-section py-5 bg-light">
    <div class="container">
        <!-- Upholstery Category -->
        <?php if (!empty($upholsteryProducts)): ?>
        <div class="category-detail mb-5">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <h3 class="mb-3"><?= $translations['upholstery'] ?? 'Upholstery Collection' ?></h3>
                    <p><?= $translations['upholstery_description'] ?? 'Premium upholstered furniture with various fabric and leather options. Customizable to your preferences.' ?></p>
                    <a href="<?= base_url('products/upholstery') ?>" class="btn btn-primary">
                        <?= $translations['view_collection'] ?? 'View Collection' ?>
                    </a>
                </div>
                <div class="col-lg-8">
                    <div class="row g-3">
                        <?php foreach (array_slice($upholsteryProducts, 0, 3) as $product): ?>
                        <div class="col-md-4">
                            <div class="category-product">
                                <img src="<?= $product['image_url'] ?>" 
                                     alt="<?= $product['name'] ?>" 
                                     class="img-fluid rounded">
                                <h6 class="mt-2"><?= $product['name'] ?></h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Wooden Furniture Category -->
        <?php if (!empty($furnitureProducts)): ?>
        <div class="category-detail">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <?php foreach (array_slice($furnitureProducts, 0, 3) as $product): ?>
                        <div class="col-md-4">
                            <div class="category-product">
                                <img src="<?= $product['image_url'] ?>" 
                                     alt="<?= $product['name'] ?>" 
                                     class="img-fluid rounded">
                                <h6 class="mt-2"><?= $product['name'] ?></h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3 class="mb-3"><?= $translations['wooden_furniture'] ?? 'Wooden Furniture' ?></h3>
                    <p><?= $translations['wooden_furniture_description'] ?? 'Handcrafted wooden furniture made from quality timber. Traditional craftsmanship with modern design.' ?></p>
                    <a href="<?= base_url('products/wooden-furniture') ?>" class="btn btn-primary">
                        <?= $translations['view_collection'] ?? 'View Collection' ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Why Choose Us -->
<?php if (!empty($services)): ?>
<section class="services-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['why_choose_us'] ?? 'Why Choose Us' ?></h2>
        <div class="row g-4">
            <?php foreach ($services as $service): ?>
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="<?= $service['icon'] ?? 'fas fa-check-circle' ?> fa-3x text-primary"></i>
                    </div>
                    <h5><?= $service['title'] ?></h5>
                    <p><?= $service['description'] ?? '' ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Statistics -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4"><?= $stats['years'] ?? '19+' ?></h3>
                    <p><?= $translations['years_experience'] ?? 'Years of Experience' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4"><?= $stats['projects'] ?? '850+' ?></h3>
                    <p><?= $translations['projects_completed'] ?? 'Projects Completed' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4"><?= $stats['clients'] ?? '420+' ?></h3>
                    <p><?= $translations['happy_clients'] ?? 'Happy Clients' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4"><?= $stats['countries'] ?? '12+' ?></h3>
                    <p><?= $translations['countries_served'] ?? 'Countries Served' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="testimonials-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['testimonials'] ?? 'Client Testimonials' ?></h2>
        <div class="row">
            <div class="col-12">
                <div class="testimonials-slider">
                    <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-item p-4">
                        <div class="testimonial-content">
                            <p class="testimonial-text">"<?= $testimonial['testimonial_text'] ?>"</p>
                        </div>
                        <div class="testimonial-author mt-4">
                            <div class="author-info">
                                <h6 class="mb-1"><?= $testimonial['client_name'] ?></h6>
                                <p class="small mb-0"><?= $testimonial['client_title'] ?><?= $testimonial['client_company'] ? ', ' . $testimonial['client_company'] : '' ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Gallery -->
<?php if (!empty($gallery)): ?>
<section class="gallery-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['gallery'] ?? 'Our Gallery' ?></h2>
        <div class="row g-3">
            <?php foreach (array_slice($gallery, 0, 8) as $item): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="gallery-item">
                    <img src="<?= $item['image_url'] ?>" 
                         alt="<?= $item['gallery_title'] ?? 'Gallery Image' ?>" 
                         class="img-fluid">
                    <div class="gallery-overlay">
                        <h6><?= $item['gallery_title'] ?? '' ?></h6>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Custom Design Section -->
<section class="custom-design-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="<?= $translations['custom_design'] ?? 'Custom Design' ?>" 
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4"><?= $translations['custom_design'] ?? 'Custom Furniture Design' ?></h2>
                <p class="mb-4"><?= $translations['custom_design_description'] ?? 'We specialize in creating custom furniture pieces tailored to your specific requirements, space, and style preferences.' ?></p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> <?= $translations['custom_size'] ?? 'Custom sizes and dimensions' ?></li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> <?= $translations['material_selection'] ?? 'Material selection consultation' ?></li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> <?= $translations['design_consultation'] ?? 'Design consultation with experts' ?></li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> <?= $translations['production_oversight'] ?? 'Production oversight and quality control' ?></li>
                </ul>
                <a href="#contact" class="btn btn-primary mt-3">
                    <?= $translations['request_consultation'] ?? 'Request Consultation' ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section py-5">
    <div class="container">
        <div class="cta-content text-center p-5 rounded">
            <h2 class="cta-title mb-4"><?= $translations['ready_to_transform'] ?? 'Ready to Transform Your Space?' ?></h2>
            <p class="cta-description mb-4"><?= $translations['cta_description'] ?? 'Contact us for custom furniture solutions or request a free consultation with our design experts.' ?></p>
            <div class="cta-buttons">
                <a href="#contact" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-phone me-2"></i> <?= $translations['contact_us'] ?? 'Contact Us' ?>
                </a>
                <a href="<?= base_url('download-catalog') ?>" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-download me-2"></i> <?= $translations['download_catalog'] ?? 'Download Catalog' ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section id="contact" class="contact-info-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-item text-center p-4">
                    <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                    <h5><?= $translations['address'] ?? 'Address' ?></h5>
                    <p><?= $companyInfo['company_address'] ?? 'Dusun 1, Suwawal, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452' ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-item text-center p-4">
                    <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                    <h5><?= $translations['phone'] ?? 'Phone' ?></h5>
                    <p><?= $companyInfo['company_phone'] ?? '+62 291 591741' ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-item text-center p-4">
                    <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                    <h5><?= $translations['email'] ?? 'Email' ?></h5>
                    <p><?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>

<!-- Testimonials Slider Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple testimonials slider
    const testimonials = document.querySelectorAll('.testimonial-item');
    let currentTestimonial = 0;
    
    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.style.display = i === index ? 'block' : 'none';
        });
    }
    
    if (testimonials.length > 0) {
        showTestimonial(0);
        
        // Auto rotate testimonials
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }, 5000);
    }
});
</script>

