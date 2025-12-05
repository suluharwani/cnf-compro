<?= $this->include('templates/header') ?>

<?= $this->include('templates/nav') ?>

<!-- Hero Section -->
<section class="about-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3"><?= $translations['about_title'] ?? 'About Our Company' ?></h1>
                <p class="lead mb-4"><?= $translations['company_description'] ?? 'Premium furniture manufacturer from Jepara' ?></p>
                <div class="about-stats d-flex gap-4">
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $stats['years'] ?? '19+' ?></h3>
                        <p class="small mb-0"><?= $translations['years_experience'] ?? 'Years of Experience' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $stats['projects'] ?? '850+' ?></h3>
                        <p class="small mb-0"><?= $translations['projects_completed'] ?? 'Projects Completed' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $stats['clients'] ?? '420+' ?></h3>
                        <p class="small mb-0"><?= $translations['happy_clients'] ?? 'Happy Clients' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-hero-image">
                    <img src="https://images.unsplash.com/photo-1581539250439-c96689b516dd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="<?= $translations['about_title'] ?? 'About Us' ?>" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section class="story-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title mb-4"><?= $translations['our_story'] ?? 'Our Story' ?></h2>
                <p class="lead mb-4"><?= $aboutData['story'] ?? 'Our company story...' ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision-section py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mission-card p-5 h-100">
                    <div class="mission-icon mb-4">
                        <i class="fas fa-bullseye fa-3x text-primary"></i>
                    </div>
                    <h3 class="mb-3"><?= $translations['our_mission'] ?? 'Our Mission' ?></h3>
                    <p class="mb-0"><?= $aboutData['mission'] ?? 'Our mission statement...' ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="vision-card p-5 h-100">
                    <div class="vision-icon mb-4">
                        <i class="fas fa-eye fa-3x text-primary"></i>
                    </div>
                    <h3 class="mb-3"><?= $translations['our_vision'] ?? 'Our Vision' ?></h3>
                    <p class="mb-0"><?= $aboutData['vision'] ?? 'Our vision statement...' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- History Timeline -->
<section class="timeline-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['our_history'] ?? 'Our History Timeline' ?></h2>
        
        <div class="timeline">
            <?php foreach ($aboutData['history_timeline'] as $index => $item): ?>
            <div class="timeline-item <?= $index % 2 === 0 ? 'left' : 'right' ?>">
                <div class="timeline-content">
                    <div class="timeline-year"><?= $item['year'] ?></div>
                    <div class="timeline-card">
                        <div class="timeline-icon">
                            <i class="<?= $item['icon'] ?> fa-2x text-<?= $item['color'] ?>"></i>
                        </div>
                        <h4><?= $item['title'] ?></h4>
                        <p><?= $item['description'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="values-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['our_values'] ?? 'Our Core Values' ?></h2>
        
        <div class="row g-4">
            <?php foreach ($aboutData['values'] as $value): ?>
            <div class="col-lg-4 col-md-6">
                <div class="value-card text-center p-4 h-100">
                    <div class="value-icon mb-3">
                        <i class="<?= $value['icon'] ?> fa-3x text-<?= $value['color'] ?>"></i>
                    </div>
                    <h5 class="mb-3"><?= $value['title'] ?></h5>
                    <p><?= $value['description'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Our Team -->
<section class="team-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['meet_team'] ?? 'Meet Our Team' ?></h2>
        
        <div class="row g-4">
            <?php foreach ($aboutData['team'] as $member): ?>
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?= $member['image'] ?>" 
                             alt="<?= $member['name'] ?>" 
                             class="img-fluid">
                        <div class="team-overlay">
                            <div class="team-social">
                                <?php if (in_array('linkedin', $member['social'])): ?>
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <?php endif; ?>
                                <?php if (in_array('email', $member['social'])): ?>
                                <a href="#" class="social-icon"><i class="fas fa-envelope"></i></a>
                                <?php endif; ?>
                                <?php if (in_array('instagram', $member['social'])): ?>
                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <?php endif; ?>
                                <?php if (in_array('whatsapp', $member['social'])): ?>
                                <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="team-info p-3">
                        <h5 class="mb-1"><?= $member['name'] ?></h5>
                        <p class="text-muted small mb-2"><?= $member['position'] ?></p>
                        <p class="small"><?= $member['bio'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Certifications -->
<section class="certifications-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['certifications'] ?? 'Our Certifications' ?></h2>
        
        <div class="row g-4">
            <?php foreach ($aboutData['certifications'] as $cert): ?>
            <div class="col-lg-3 col-md-6">
                <div class="cert-card text-center p-4">
                    <div class="cert-icon mb-3">
                        <i class="<?= $cert['icon'] ?> fa-3x text-primary"></i>
                    </div>
                    <h5 class="mb-2"><?= $cert['name'] ?></h5>
                    <p class="small mb-0"><?= $cert['description'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Facilities -->
<section class="facilities-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['our_facilities'] ?? 'Our Facilities' ?></h2>
        
        <div class="row g-4">
            <?php foreach ($aboutData['facilities'] as $facility): ?>
            <div class="col-lg-3 col-md-6">
                <div class="facility-card">
                    <div class="facility-image">
                        <img src="<?= $facility['image'] ?>" 
                             alt="<?= $facility['name'] ?>" 
                             class="img-fluid">
                    </div>
                    <div class="facility-info p-3">
                        <h5 class="mb-2"><?= $facility['name'] ?></h5>
                        <p class="small mb-0"><?= $facility['description'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Location Map -->
<section class="location-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4"><?= $translations['our_location'] ?? 'Our Location' ?></h2>
                <p class="mb-4">
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                    <?= $companyInfo['company_address'] ?? 'Dusun 1, Suwawal, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452' ?>
                </p>
                <div class="location-info">
                    <p class="mb-2">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <?= $companyInfo['company_phone'] ?? '+62 291 591741' ?>
                    </p>
                    <p class="mb-4">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?>
                    </p>
                    <a href="#contact" class="btn btn-primary">
                        <i class="fas fa-directions me-2"></i> <?= $translations['get_directions'] ?? 'Get Directions' ?>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="location-map">
                    <div class="map-placeholder p-4 text-center bg-white rounded shadow">
                        <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                        <h5><?= $companyInfo['company_name'] ?? 'PT Chakra Naga Furniture' ?></h5>
                        <p class="mb-0"><?= $companyInfo['company_address'] ?? 'Jepara, Central Java' ?></p>
                        <a href="https://maps.google.com/?q=<?= urlencode($companyInfo['company_address'] ?? 'Jepara') ?>" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-primary mt-3">
                            <i class="fas fa-external-link-alt me-2"></i> <?= $translations['view_on_map'] ?? 'View on Google Maps' ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="about-cta py-5">
    <div class="container">
        <div class="cta-content text-center p-5 rounded">
            <h2 class="cta-title mb-4"><?= $translations['work_with_us'] ?? 'Work With Us' ?></h2>
            <p class="cta-description mb-4"><?= $translations['about_cta_desc'] ?? 'Partner with PT Chakra Naga Furniture for your furniture needs. Experience quality craftsmanship and exceptional service.' ?></p>
            <div class="cta-buttons">
                <a href="#contact" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i> <?= $translations['contact_us'] ?? 'Contact Us' ?>
                </a>
                <a href="<?= base_url('career') ?>" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-briefcase me-2"></i> <?= $translations['join_team'] ?? 'Join Our Team' ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>

<style>
/* About Page Specific Styles */
.about-hero {
    background: linear-gradient(135deg, #F8F4E9 0%, #FFFFFF 100%);
}

.about-hero-image img {
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.about-stats {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.about-stats .stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.about-stats .stat-item p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0;
}

/* Mission & Vision Cards */
.mission-card, .vision-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.mission-card:hover, .vision-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.mission-icon, .vision-icon {
    color: var(--primary-color);
}

/* Timeline */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 0;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 6px;
    background: var(--primary-color);
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -3px;
    border-radius: 3px;
}

.timeline-item {
    padding: 10px 40px;
    position: relative;
    width: 50%;
    box-sizing: border-box;
}

.timeline-item.left {
    left: 0;
}

.timeline-item.right {
    left: 50%;
}

.timeline-item::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    background: white;
    border: 4px solid var(--primary-color);
    border-radius: 50%;
    top: 15px;
    z-index: 1;
}

.timeline-item.left::after {
    right: -17px;
}

.timeline-item.right::after {
    left: -17px;
}

.timeline-content {
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: relative;
}

.timeline-year {
    position: absolute;
    top: -15px;
    background: var(--primary-color);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.timeline-item.left .timeline-year {
    right: 20px;
}

.timeline-item.right .timeline-year {
    left: 20px;
}

.timeline-card {
    text-align: center;
}

.timeline-icon {
    margin-bottom: 1rem;
}

.timeline-card h4 {
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.timeline-card p {
    color: var(--text-light);
    font-size: 0.9rem;
    margin-bottom: 0;
}

/* Values Cards */
.value-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.value-icon {
    color: var(--primary-color);
}

/* Team Cards */
.team-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.team-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.team-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.team-card:hover .team-image img {
    transform: scale(1.05);
}

.team-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-card:hover .team-overlay {
    opacity: 1;
}

.team-social {
    display: flex;
    gap: 10px;
}

.team-social .social-icon {
    width: 40px;
    height: 40px;
    background: white;
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.team-social .social-icon:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
}

.team-info {
    padding: 1.5rem;
}

/* Certifications */
.cert-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.cert-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.cert-icon {
    color: var(--primary-color);
}

/* Facilities */
.facility-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.facility-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.facility-image {
    height: 200px;
    overflow: hidden;
}

.facility-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.facility-card:hover .facility-image img {
    transform: scale(1.05);
}

.facility-info {
    padding: 1.5rem;
}

/* Location Map */
.map-placeholder {
    border: 2px dashed #dee2e6;
}

/* CTA Section */
.about-cta {
    background: linear-gradient(rgba(92, 64, 51, 0.9), rgba(92, 64, 51, 0.9)), 
                url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
    background-size: cover;
    background-position: center;
    color: white;
}

.about-cta .cta-content {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border-radius: 15px;
}

.about-cta .cta-title {
    color: white;
    font-size: 2.5rem;
}

.about-cta .cta-description {
    font-size: 1.2rem;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
    .timeline::after {
        left: 31px;
    }
    
    .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }
    
    .timeline-item.right {
        left: 0;
    }
    
    .timeline-item::after {
        left: 15px;
    }
    
    .timeline-item.left .timeline-year,
    .timeline-item.right .timeline-year {
        left: 70px;
        right: auto;
    }
    
    .about-stats {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .team-card, .cert-card, .facility-card {
        margin-bottom: 1.5rem;
    }
    
    .cta-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .cta-buttons .btn:last-child {
        margin-bottom: 0;
    }
}

@media (max-width: 576px) {
    .about-stats .stat-item {
        flex: 0 0 100%;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .mission-card, .vision-card {
        padding: 2rem !important;
    }
}
</style>

<script>
// Initialize timeline animation
document.addEventListener('DOMContentLoaded', function() {
    // Animate timeline items on scroll
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    timelineItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'all 0.6s ease';
        observer.observe(item);
    });
    
    // Animate value cards
    const valueCards = document.querySelectorAll('.value-card');
    
    const valueObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });
    
    valueCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        valueObserver.observe(card);
    });
});
</script>