<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="PT Chakra Naga Furniture" height="60" class="d-inline-block align-top">
            <div class="brand-text ms-2">
                <span class="brand-name fw-bold"><?= $companyInfo['company_name'] ?? 'Chakra Naga Furniture' ?></span>
                <span class="brand-tagline d-block small text-muted"><?= $companyInfo['company_tagline'] ?? 'Premium Furniture Manufacturer' ?></span>
            </div>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <!-- Home -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center <?= $activePage === 'home' ? 'active' : '' ?>" href="<?= base_url() ?>">
                        <i class="fas fa-home me-2"></i>
                        <span><?= $translations['nav_home'] ?? 'Home' ?></span>
                    </a>
                </li>
                
                <!-- About -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center" href="about">
                        <i class="fas fa-info-circle me-2"></i>
                        <span><?= $translations['nav_about'] ?? 'About Us' ?></span>
                    </a>
                </li>
                
                <!-- Products Dropdown -->
                <li class="nav-item dropdown mx-1">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-couch me-2"></i>
                        <span><?= $translations['nav_products'] ?? 'Products' ?></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        <!-- Dynamic Categories from Database -->
                        <?php if (!empty($categories)): ?>
                            <?php foreach (array_slice($categories, 0, 5) as $category): ?>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="<?= base_url('products/' . $category['slug']) ?>">
                                        <i class="<?= $category['icon'] ?? 'fas fa-couch' ?> me-2"></i>
                                        <span><?= $category['name'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <?php if (count($categories) > 5): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-center text-primary" href="<?= base_url('products') ?>">
                                        <i class="fas fa-eye me-2"></i>
                                        <?= $translations['view_all_categories'] ?? 'View All Categories' ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Fallback Categories -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#upholstery">
                                    <i class="fas fa-couch me-2"></i>
                                    <span><?= $translations['nav_upholstery'] ?? 'Upholstery' ?></span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#furniture">
                                    <i class="fas fa-chair me-2"></i>
                                    <span><?= $translations['nav_furniture'] ?? 'Furniture' ?></span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('products') ?>">
                                    <i class="fas fa-pencil-ruler me-2"></i>
                                    <span><?= $translations['custom_design'] ?? 'Custom Design' ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                
                <!-- Gallery -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center" href="gallery">
                        <i class="fas fa-images me-2"></i>
                        <span><?= $translations['nav_gallery'] ?? 'Gallery' ?></span>
                    </a>
                </li>
                
                <!-- Career -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center <?= $activePage === 'career' ? 'active' : '' ?>" href="<?= base_url('career') ?>">
                        <i class="fas fa-briefcase me-2"></i>
                        <span><?= $translations['nav_career'] ?? 'Career' ?></span>
                    </a>
                </li>
                
                <!-- Contact -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center" href="#contact">
                        <i class="fas fa-envelope me-2"></i>
                        <span><?= $translations['nav_contact'] ?? 'Contact' ?></span>
                    </a>
                </li>
                
                <!-- Catalog Download -->
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center" href="<?= base_url('download-catalog') ?>">
                        <i class="fas fa-download me-2"></i>
                        <span><?= $translations['nav_catalog'] ?? 'Catalog' ?></span>
                    </a>
                </li>
                
                <!-- Call to Action Button -->
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a href="#contact" class="btn btn-primary btn-cta d-flex align-items-center">
                        <i class="fas fa-phone-alt me-2"></i>
                        <span><?= $translations['get_quote'] ?? 'Get Quote' ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Navigation Active State Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update active nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    
    window.addEventListener('scroll', function() {
        let current = '';
        const scrollPosition = window.scrollY + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            
            if (href === '#' + current || 
                (current === '' && href === '#home') ||
                (current === '' && link.closest('.nav-item').querySelector('a[href="<?= base_url() ?>"]'))) {
                link.classList.add('active');
            }
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href !== '#' && href.startsWith('#') && document.querySelector(href)) {
                e.preventDefault();
                
                const target = document.querySelector(href);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.getElementById('navbarNav');
                    if (navbarCollapse.classList.contains('show')) {
                        new bootstrap.Collapse(navbarCollapse).hide();
                    }
                }
            }
        });
    });
    
    // Highlight current page
    const currentPath = window.location.pathname;
    const homeLink = document.querySelector('a[href="<?= base_url() ?>"]');
    const careerLink = document.querySelector('a[href="<?= base_url('career') ?>"]');
    
    if (currentPath === '/' || currentPath === '') {
        if (homeLink) homeLink.classList.add('active');
    } else if (currentPath.includes('career')) {
        if (careerLink) careerLink.classList.add('active');
    }
});
</script>

<style>
/* Navigation Styles */
.navbar {
    padding: 0.5rem 0;
    transition: all 0.3s ease;
    z-index: 1030;
}

.navbar.scrolled {
    padding: 0.3rem 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    padding: 0;
}

.brand-text {
    line-height: 1.2;
}

.brand-name {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: var(--dark-color);
    font-size: 1.4rem;
    display: block;
}

.brand-tagline {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.navbar-nav {
    gap: 0.5rem;
}

.nav-item {
    position: relative;
}

.nav-link {
    font-weight: 500;
    padding: 0.75rem 1rem !important;
    color: var(--text-color) !important;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.nav-link:hover {
    color: var(--primary-color) !important;
    background-color: rgba(139, 115, 85, 0.05);
    transform: translateY(-1px);
}

.nav-link.active {
    color: var(--primary-color) !important;
    background-color: rgba(139, 115, 85, 0.1);
    font-weight: 600;
}

.nav-link i {
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}

/* Dropdown Menu */
.dropdown-menu {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 0.5rem;
    margin-top: 0.5rem;
    min-width: 220px;
}

.dropdown-item {
    padding: 0.75rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
    color: var(--text-color);
    display: flex;
    align-items: center;
}

.dropdown-item:hover {
    background-color: rgba(139, 115, 85, 0.1);
    color: var(--primary-color);
    transform: translateX(5px);
}

.dropdown-item i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
    color: var(--primary-color);
}

/* Call to Action Button */
.btn-cta {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(139, 115, 85, 0.2);
}

.btn-cta:hover {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(139, 115, 85, 0.3);
}

/* Mobile Navigation */
@media (max-width: 991px) {
    .navbar-collapse {
        padding: 1rem 0;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 1rem;
    }
    
    .navbar-nav {
        gap: 0.25rem;
    }
    
    .nav-link {
        padding: 0.75rem 1rem !important;
        border-radius: 6px;
    }
    
    .dropdown-menu {
        border: 1px solid #eee;
        box-shadow: none;
        margin: 0.5rem 0 0.5rem 1rem;
    }
    
    .btn-cta {
        width: 100%;
        margin-top: 0.5rem;
        justify-content: center;
    }
    
    .brand-name {
        font-size: 1.2rem;
    }
    
    .brand-tagline {
        font-size: 0.7rem;
    }
}

/* Desktop Navigation */
@media (min-width: 992px) {
    .navbar-nav {
        gap: 0.5rem;
    }
    
    .nav-link {
        font-size: 0.95rem;
    }
    
    .dropdown:hover .dropdown-menu {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

/* Navbar Scroll Effect */
.navbar {
    transition: all 0.3s ease;
}

.navbar.scrolled {
    padding: 0.3rem 0;
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* Active Page Indicator */
.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    width: 5px;
    height: 5px;
    background-color: var(--primary-color);
    border-radius: 50%;
}

@media (max-width: 991px) {
    .nav-link.active::after {
        left: 10px;
        transform: none;
    }
}
</style>