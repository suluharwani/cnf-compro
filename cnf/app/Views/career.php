<?= $this->include('templates/header') ?>

<?= $this->include('templates/nav') ?>

<!-- Career Hero Section -->
<section class="career-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3"><?= $translations['career_title'] ?? $translations['join_our_team'] ?? 'Join Our Team' ?></h1>
                <p class="lead mb-4"><?= $companyInfo['company_description'] ?? 'PT Chakra Naga Furniture is a leading furniture manufacturer based in Jepara, Indonesia' ?></p>
                <div class="career-stats d-flex gap-4 mb-4">
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $companyInfo['years_experience'] ?? '19+' ?></h3>
                        <p class="small mb-0"><?= $translations['years_experience'] ?? 'Years of Experience' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= count($careers) ?></h3>
                        <p class="small mb-0"><?= $translations['open_positions'] ?? 'Open Positions' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $companyInfo['projects_completed'] ?? '850+' ?></h3>
                        <p class="small mb-0"><?= $translations['projects_completed'] ?? 'Projects Completed' ?></p>
                    </div>
                </div>
                <a href="#open-positions" class="btn btn-primary btn-lg">
                    <i class="fas fa-briefcase me-2"></i> <?= $translations['view_all_positions'] ?? 'View Open Positions' ?>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="career-hero-image">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="<?= $translations['career_hero'] ?? 'Join Our Team' ?>" 
                         class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Work With Us -->
<section class="why-work-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['why_work_with_us'] ?? 'Why Work With Us' ?></h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="benefit-card text-center p-4">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                    </div>
                    <h5><?= $translations['career_growth'] ?? 'Career Growth' ?></h5>
                    <p><?= $translations['career_growth_desc'] ?? 'Opportunities for professional development and career advancement' ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center p-4">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-heartbeat fa-3x text-primary"></i>
                    </div>
                    <h5><?= $translations['health_benefits'] ?? 'Health Benefits' ?></h5>
                    <p><?= $translations['health_benefits_desc'] ?? 'Comprehensive health insurance and wellness programs' ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center p-4">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-balance-scale fa-3x text-primary"></i>
                    </div>
                    <h5><?= $translations['work_life_balance'] ?? 'Work-Life Balance' ?></h5>
                    <p><?= $translations['work_life_balance_desc'] ?? 'Flexible working hours and supportive work environment' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Open Positions -->
<section id="open-positions" class="positions-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['open_positions'] ?? 'Open Positions' ?></h2>
        
        <?php if (empty($careers)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            <?= $translations['no_positions'] ?? 'No positions available at the moment. Please check back later.' ?>
        </div>
        <?php else: ?>
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Career List -->
                <div class="career-list">
                    <?php foreach ($careers as $index => $career): ?>
                    <div class="career-card mb-4" id="position-<?= $career['job_code'] ?>">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="card-title mb-1"><?= $career['title'] ?></h4>
                                        <div class="career-meta mb-3">
                                            <span class="badge bg-primary me-2">
                                                <i class="fas fa-building me-1"></i> <?= $career['department'] ?>
                                            </span>
                                            <span class="badge bg-secondary me-2">
                                                <i class="fas fa-map-marker-alt me-1"></i> <?= $career['location'] ?>
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="fas fa-clock me-1"></i> 
                                                <?= $translations[$career['employment_type']] ?? ucfirst(str_replace('_', ' ', $career['employment_type'])) ?>
                                            </span>
                                            <?php if ($career['is_urgent']): ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-exclamation-circle me-1"></i> <?= $translations['urgent'] ?? 'Urgent' ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <?php if ($career['salary_range']): ?>
                                        <h5 class="text-primary mb-2"><?= $career['salary_range'] ?></h5>
                                        <?php endif; ?>
                                        <small class="text-muted">
                                            <?= $translations['posted'] ?? 'Posted' ?>: <?= date('d M Y', strtotime($career['posted_date'])) ?>
                                        </small>
                                    </div>
                                </div>
                                
                                <p class="card-text mb-4"><?= $career['description'] ?></p>
                                
                                <div class="row mb-4">
                                    <?php if ($career['requirements']): ?>
                                    <div class="col-md-6">
                                        <h6 class="mb-3"><i class="fas fa-clipboard-check text-primary me-2"></i> <?= $translations['requirements'] ?? 'Requirements' ?></h6>
                                        <p class="small"><?= $career['requirements'] ?></p>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($career['benefits']): ?>
                                    <div class="col-md-6">
                                        <h6 class="mb-3"><i class="fas fa-gift text-primary me-2"></i> <?= $translations['benefits'] ?? 'Benefits' ?></h6>
                                        <p class="small"><?= $career['benefits'] ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-user-friends me-1"></i>
                                            <?= $translations['vacancies'] ?? 'Vacancies' ?>: <?= $career['vacancies'] ?>
                                        </small>
                                        <?php if ($career['deadline_date']): ?>
                                        <small class="text-muted ms-3">
                                            <i class="fas fa-calendar-times me-1"></i>
                                            <?= $translations['deadline'] ?? 'Deadline' ?>: <?= date('d M Y', strtotime($career['deadline_date'])) ?>
                                        </small>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="btn btn-primary apply-btn" data-position="<?= $career['title'] ?>" data-code="<?= $career['job_code'] ?>">
                                        <i class="fas fa-paper-plane me-2"></i> <?= $translations['apply_now'] ?? 'Apply Now' ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Application Form -->
                <div class="application-form-sidebar sticky-top">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i> <?= $translations['apply_now'] ?? 'Apply Now' ?></h5>
                        </div>
                        <div class="card-body p-4">
                            <form id="applicationForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="applyPosition" name="position">
                                <input type="hidden" id="applyJobCode" name="job_code">
                                
                                <div class="mb-3">
                                    <label for="fullName" class="form-label"><?= $translations['name_label'] ?? 'Full Name' ?> *</label>
                                    <input type="text" class="form-control" id="fullName" name="full_name" required>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label"><?= $translations['email_label'] ?? 'Email' ?> *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label"><?= $translations['phone_label'] ?? 'Phone' ?> *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="positionSelect" class="form-label"><?= $translations['apply_for_position'] ?? 'Position Applied For' ?> *</label>
                                    <select class="form-control" id="positionSelect" required>
                                        <option value=""><?= $translations['select_position'] ?? 'Select Position' ?></option>
                                        <?php foreach ($careers as $career): ?>
                                        <option value="<?= $career['job_code'] ?>" data-title="<?= $career['title'] ?>">
                                            <?= $career['title'] ?> (<?= $career['job_code'] ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="coverLetter" class="form-label"><?= $translations['cover_letter'] ?? 'Cover Letter' ?></label>
                                    <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4" placeholder="<?= $translations['cover_letter_placeholder'] ?? 'Tell us why you are interested in this position...' ?>"></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="resume" class="form-label"><?= $translations['resume_cv'] ?? 'Resume/CV' ?> *</label>
                                    <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                    <small class="text-muted"><?= $translations['file_types'] ?? 'PDF, DOC, DOCX (Max 5MB)' ?></small>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="portfolio" class="form-label"><?= $translations['portfolio'] ?? 'Portfolio/Work Samples' ?></label>
                                    <input type="file" class="form-control" id="portfolio" name="portfolio" accept=".pdf,.zip,.rar">
                                    <small class="text-muted"><?= $translations['portfolio_hint'] ?? 'Optional: PDF or ZIP file with your work samples' ?></small>
                                </div>
                                
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label small" for="agreeTerms">
                                        <?= $translations['agree_terms'] ?? 'I agree to the processing of my personal data for recruitment purposes' ?>
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i> <?= $translations['submit_application'] ?? 'Submit Application' ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Company Culture -->
                <div class="company-culture mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="mb-3"><i class="fas fa-users text-primary me-2"></i> <?= $translations['our_culture'] ?? 'Our Culture' ?></h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= $translations['culture_collaborative'] ?? 'Collaborative and supportive environment' ?></li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= $translations['culture_learning'] ?? 'Continuous learning and development' ?></li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= $translations['culture_innovation'] ?? 'Innovation and creativity encouraged' ?></li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= $translations['culture_respect'] ?? 'Respect and diversity valued' ?></li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= $translations['culture_work_life'] ?? 'Work-life balance supported' ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Contact HR -->
                <div class="contact-hr mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="mb-3"><i class="fas fa-headset text-primary me-2"></i> <?= $translations['hr_contact'] ?? 'HR Contact' ?></h5>
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i> <?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?></p>
                            <p class="mb-0"><i class="fas fa-phone me-2"></i> <?= $companyInfo['company_phone'] ?? '+62 291 591741' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Application Process -->
<section class="process-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['application_process'] ?? 'Application Process' ?></h2>
        <div class="row">
            <div class="col-md-3">
                <div class="process-step text-center">
                    <div class="step-number">1</div>
                    <h5 class="mt-3"><?= $translations['step_apply'] ?? 'Apply' ?></h5>
                    <p><?= $translations['step_apply_desc'] ?? 'Submit your application online' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step text-center">
                    <div class="step-number">2</div>
                    <h5 class="mt-3"><?= $translations['step_review'] ?? 'Review' ?></h5>
                    <p><?= $translations['step_review_desc'] ?? 'HR team reviews your application' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step text-center">
                    <div class="step-number">3</div>
                    <h5 class="mt-3"><?= $translations['step_interview'] ?? 'Interview' ?></h5>
                    <p><?= $translations['step_interview_desc'] ?? 'Interview with team/department head' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step text-center">
                    <div class="step-number">4</div>
                    <h5 class="mt-3"><?= $translations['step_offer'] ?? 'Offer' ?></h5>
                    <p><?= $translations['step_offer_desc'] ?? 'Receive job offer and onboard' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Employee Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="employee-testimonials py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['employee_stories'] ?? 'Employee Stories' ?></h2>
        <div class="row">
            <?php foreach (array_slice($testimonials, 0, 3) as $testimonial): ?>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p class="testimonial-text">"<?= $testimonial['testimonial_text'] ?>"</p>
                    </div>
                    <div class="testimonial-author mt-4">
                        <div class="author-info">
                            <h6 class="mb-1"><?= $testimonial['client_name'] ?></h6>
                            <p class="small mb-0 text-muted"><?= $testimonial['client_title'] ?><?= $testimonial['client_company'] ? ', ' . $testimonial['client_company'] : '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="career-cta py-5">
    <div class="container">
        <div class="cta-content text-center p-5 rounded">
            <h2 class="cta-title mb-4"><?= $translations['ready_to_join'] ?? 'Ready to Join Our Team?' ?></h2>
            <p class="cta-description mb-4"><?= $translations['career_cta_desc'] ?? 'Take the next step in your career with PT Chakra Naga Furniture' ?></p>
            <div class="cta-buttons">
                <a href="#open-positions" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-briefcase me-2"></i> <?= $translations['view_positions'] ?? 'View Open Positions' ?>
                </a>
                <a href="mailto:<?= $companyInfo['company_email'] ?? 'luqi@chakranaga.com' ?>" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-envelope me-2"></i> <?= $translations['contact_hr'] ?? 'Contact HR' ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Application Success -->
<div class="modal fade" id="applicationSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-check-circle me-2"></i> <?= $translations['application_success'] ?? 'Application Submitted' ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle fa-5x text-success"></i>
                </div>
                <h4 class="mb-3"><?= $translations['thank_you_application'] ?? 'Thank You for Your Application!' ?></h4>
                <p class="mb-4"><?= $translations['application_received'] ?? 'We have received your application and will review it shortly. Our HR team will contact you if there is a match.' ?></p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?= $translations['close'] ?? 'Close' ?></button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<!-- Application Form JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set apply button click handlers
    document.querySelectorAll('.apply-btn').forEach(button => {
        button.addEventListener('click', function() {
            const position = this.getAttribute('data-position');
            const jobCode = this.getAttribute('data-code');
            
            // Set form values
            document.getElementById('applyPosition').value = position;
            document.getElementById('applyJobCode').value = jobCode;
            document.getElementById('positionSelect').value = jobCode;
            
            // Scroll to form
            document.getElementById('applicationForm').scrollIntoView({ behavior: 'smooth' });
            
            // Highlight selected position
            document.querySelectorAll('.career-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.getElementById('position-' + jobCode).classList.add('selected');
        });
    });
    
    // Position select change handler
    const positionSelect = document.getElementById('positionSelect');
    if (positionSelect) {
        positionSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const jobCode = this.value;
            const positionTitle = selectedOption.getAttribute('data-title');
            
            if (jobCode) {
                document.getElementById('applyPosition').value = positionTitle;
                document.getElementById('applyJobCode').value = jobCode;
                
                // Scroll to position
                const positionElement = document.getElementById('position-' + jobCode);
                if (positionElement) {
                    positionElement.scrollIntoView({ behavior: 'smooth' });
                    
                    // Highlight selected position
                    document.querySelectorAll('.career-card').forEach(card => {
                        card.classList.remove('selected');
                    });
                    positionElement.classList.add('selected');
                }
            }
        });
    }
    
    // Form submission handler
    const applicationForm = document.getElementById('applicationForm');
    if (applicationForm) {
        applicationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate file size
            const resumeInput = document.getElementById('resume');
            if (resumeInput.files.length > 0) {
                const fileSize = resumeInput.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 5) {
                    alert('<?= $translations["file_too_large"] ?? "File size exceeds 5MB limit" ?>');
                    return;
                }
            }
            
            // Validate position selection
            const position = document.getElementById('applyJobCode').value;
            if (!position) {
                alert('<?= $translations["select_position_first"] ?? "Please select a position first" ?>');
                return;
            }
            
            // Validate terms agreement
            const agreeTerms = document.getElementById('agreeTerms');
            if (!agreeTerms.checked) {
                alert('<?= $translations["agree_terms_required"] ?? "Please agree to the terms and conditions" ?>');
                return;
            }
            
            // In a real application, you would submit to server here
            // For demo purposes, show success modal
            const modal = new bootstrap.Modal(document.getElementById('applicationSuccessModal'));
            modal.show();
            
            // Reset form
            this.reset();
            document.getElementById('applyPosition').value = '';
            document.getElementById('applyJobCode').value = '';
        });
    }
    
    // File preview for resume
    const resumeInput = document.getElementById('resume');
    if (resumeInput) {
        resumeInput.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            if (fileName) {
                const fileExtension = fileName.split('.').pop().toLowerCase();
                const allowedExtensions = ['pdf', 'doc', 'docx'];
                
                if (!allowedExtensions.includes(fileExtension)) {
                    alert('<?= $translations["invalid_file_type"] ?? "Please upload PDF, DOC, or DOCX files only" ?>');
                    this.value = '';
                }
            }
        });
    }
});
</script>

<style>
/* Career Page Specific Styles */
.career-hero {
    background: linear-gradient(135deg, var(--light-color) 0%, #fff 100%);
}

.career-stats .stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.career-stats .stat-item p {
    font-size: 0.9rem;
    color: var(--text-light);
}

.career-hero-image {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

/* Career Cards */
.career-card {
    transition: all 0.3s ease;
}

.career-card.selected {
    border-left: 4px solid var(--primary-color);
    transform: translateX(5px);
}

.career-card .card {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.career-card:hover .card {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.career-meta .badge {
    font-size: 0.8rem;
    padding: 5px 10px;
}

/* Benefit Cards */
.benefit-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.benefit-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.benefit-icon {
    color: var(--primary-color);
}

/* Application Form Sidebar */
.application-form-sidebar {
    top: 20px;
}

.application-form-sidebar .card {
    border-radius: 10px;
}

/* Process Steps */
.process-step {
    padding: 20px;
}

.step-number {
    width: 60px;
    height: 60px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 auto;
}

.process-step h5 {
    color: var(--dark-color);
    font-weight: 600;
}

.process-step p {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Testimonial Cards */
.testimonial-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.testimonial-text {
    font-style: italic;
    color: var(--text-color);
    line-height: 1.6;
    margin-bottom: 0;
}

/* CTA Section */
.career-cta {
    background: linear-gradient(rgba(92, 64, 51, 0.9), rgba(92, 64, 51, 0.9)), 
                url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
    background-size: cover;
    background-position: center;
    color: white;
}

.career-cta .cta-content {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
}

.career-cta .cta-title {
    color: white;
}

/* Form Styling */
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(139, 115, 85, 0.25);
}

/* Responsive */
@media (max-width: 768px) {
    .career-hero {
        text-align: center;
    }
    
    .career-stats {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .process-step {
        margin-bottom: 2rem;
    }
    
    .application-form-sidebar {
        margin-top: 2rem;
    }
}

@media (max-width: 576px) {
    .career-meta .badge {
        display: block;
        margin-bottom: 5px;
        width: fit-content;
    }
    
    .career-card .d-flex {
        flex-direction: column;
    }
    
    .career-card .text-end {
        text-align: left !important;
        margin-top: 1rem;
    }
}
</style>