<?= $this->include('templates/header') ?>

<?= $this->include('templates/nav') ?>

<!-- Gallery Hero -->
<section class="gallery-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3"><?= $translations['gallery_title'] ?? 'Our Gallery' ?></h1>
                <p class="lead mb-4"><?= $translations['gallery_description'] ?? 'Explore our furniture collection, workshop processes, and completed projects' ?></p>
                <div class="gallery-stats d-flex gap-4">
                    <div class="stat-item">
                        <h3 class="mb-0"><?= $totalItems ?></h3>
                        <p class="small mb-0"><?= $translations['total_images'] ?? 'Total Images' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= count($galleryTypes) - 1 ?></h3>
                        <p class="small mb-0"><?= $translations['categories'] ?? 'Categories' ?></p>
                    </div>
                    <div class="stat-item">
                        <h3 class="mb-0"><?= date('Y') - 2005 ?></h3>
                        <p class="small mb-0"><?= $translations['years_archive'] ?? 'Years Archive' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="gallery-hero-image">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="<?= $translations['gallery'] ?? 'Gallery' ?>" 
                         class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Controls -->
<section class="gallery-controls py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-0">
                <!-- Search Box -->
                <div class="search-box">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-start-0" 
                               id="searchInput" 
                               placeholder="<?= $translations['search_placeholder'] ?? 'Search images by name or description...' ?>">
                        <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 mb-3 mb-lg-0">
                <!-- Category Filter -->
                <div class="category-filter">
                    <div class="btn-group" role="group" aria-label="Gallery categories">
                        <?php foreach ($galleryTypes as $type): ?>
                        <button type="button" 
                                class="btn btn-outline-primary category-btn <?= $type['value'] === 'all' ? 'active' : '' ?>" 
                                data-category="<?= $type['value'] ?>">
                            <i class="<?= $type['icon'] ?> me-2"></i>
                            <?= $type['label'] ?>
                            <span class="badge bg-primary ms-2"><?= $type['count'] ?></span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <!-- Sort Options -->
                <div class="sort-options">
                    <select class="form-select" id="sortSelect">
                        <option value="newest"><?= $translations['sort_newest'] ?? 'Newest First' ?></option>
                        <option value="oldest"><?= $translations['sort_oldest'] ?? 'Oldest First' ?></option>
                        <option value="name_asc"><?= $translations['sort_name_az'] ?? 'Name A-Z' ?></option>
                        <option value="name_desc"><?= $translations['sort_name_za'] ?? 'Name Z-A' ?></option>
                        <option value="category"><?= $translations['sort_category'] ?? 'By Category' ?></option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Active Filters Display -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="active-filters" id="activeFilters">
                    <!-- Active filters will be displayed here -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-grid py-5">
    <div class="container">
        <!-- Gallery Loading -->
        <div class="gallery-loading text-center py-5" id="galleryLoading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3"><?= $translations['loading_gallery'] ?? 'Loading gallery images...' ?></p>
        </div>
        
        <!-- Gallery Items -->
        <div class="row" id="galleryContainer">
            <?php foreach ($galleryItems as $item): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 gallery-item" 
                 data-category="<?= $item['gallery_type'] ?>"
                 data-title="<?= strtolower($item['gallery_title'] ?? '') ?>"
                 data-date="<?= strtotime($item['created_at']) ?>">
                <div class="gallery-card">
                    <div class="gallery-image">
                        <img src="<?= $item['image_url'] ?>" 
                             alt="<?= $item['gallery_title'] ?? 'Gallery Image' ?>" 
                             class="img-fluid"
                             loading="lazy">
                        <div class="gallery-overlay">
                            <div class="gallery-info">
                                <h6 class="mb-1"><?= $item['gallery_title'] ?? 'Image' ?></h6>
                                <p class="small mb-2"><?= $item['description'] ?? '' ?></p>
                                <span class="badge bg-primary">
                                    <i class="fas fa-tag me-1"></i>
                                    <?= $item['gallery_type'] ?>
                                </span>
                            </div>
                            <div class="gallery-actions">
                                <button class="btn btn-sm btn-light view-btn" 
                                        data-image="<?= $item['image_url'] ?>"
                                        data-title="<?= $item['gallery_title'] ?? '' ?>"
                                        data-description="<?= $item['description'] ?? '' ?>"
                                        data-category="<?= $item['gallery_type'] ?>">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button class="btn btn-sm btn-light download-btn" 
                                        data-image="<?= $item['image_url'] ?>"
                                        data-title="<?= $item['gallery_title'] ?? '' ?>">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- No Results -->
        <div class="no-results text-center py-5 d-none" id="noResults">
            <i class="fas fa-images fa-4x text-muted mb-3"></i>
            <h4><?= $translations['no_results'] ?? 'No Images Found' ?></h4>
            <p class="text-muted"><?= $translations['try_different_search'] ?? 'Try a different search or filter' ?></p>
        </div>
        
        <!-- Load More -->
        <div class="text-center mt-4" id="loadMoreContainer">
            <button class="btn btn-outline-primary" id="loadMoreBtn">
                <i class="fas fa-plus me-2"></i>
                <?= $translations['load_more'] ?? 'Load More Images' ?>
            </button>
        </div>
    </div>
</section>

<!-- Category Highlights -->
<section class="category-highlights py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5"><?= $translations['gallery_categories'] ?? 'Gallery Categories' ?></h2>
        
        <div class="row g-4">
            <?php foreach ($galleryTypes as $type): ?>
                <?php if ($type['value'] !== 'all' && isset($groupedGallery[$type['value']]) && count($groupedGallery[$type['value']]) > 0): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="<?= $groupedGallery[$type['value']][0]['image_url'] ?>" 
                                 alt="<?= $type['label'] ?>" 
                                 class="img-fluid">
                            <div class="category-overlay">
                                <h5 class="mb-2"><?= $type['label'] ?></h5>
                                <p class="small mb-0"><?= $type['count'] ?> <?= $translations['images'] ?? 'images' ?></p>
                                <a href="#" class="btn btn-sm btn-light mt-2 view-category" 
                                   data-category="<?= $type['value'] ?>">
                                    <?= $translations['view_all'] ?? 'View All' ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="imageLightbox" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="modal-title">
                    <h5 id="lightboxTitle"></h5>
                    <p class="small text-muted mb-0" id="lightboxCategory"></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="lightbox-image-container">
                    <img id="lightboxImage" src="" alt="" class="img-fluid">
                </div>
                <div class="lightbox-info p-4">
                    <p id="lightboxDescription"></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small" id="lightboxDimensions"></span>
                        </div>
                        <div class="lightbox-actions">
                            <button class="btn btn-outline-primary btn-sm" id="lightboxPrev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-outline-primary btn-sm" id="lightboxNext">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" id="lightboxDownload">
                                <i class="fas fa-download me-2"></i>
                                <?= $translations['download_image'] ?? 'Download' ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-download me-2"></i>
                    <?= $translations['download_image'] ?? 'Download Image' ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="download-preview mb-4 text-center">
                    <img id="downloadPreview" src="" alt="" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <form id="downloadForm">
                    <div class="mb-3">
                        <label for="downloadName" class="form-label"><?= $translations['image_name'] ?? 'Image Name' ?></label>
                        <input type="text" class="form-control" id="downloadName" required>
                    </div>
                    <div class="mb-3">
                        <label for="downloadSize" class="form-label"><?= $translations['image_size'] ?? 'Select Size' ?></label>
                        <select class="form-select" id="downloadSize">
                            <option value="original"><?= $translations['size_original'] ?? 'Original Size' ?></option>
                            <option value="large"><?= $translations['size_large'] ?? 'Large (1200px)' ?></option>
                            <option value="medium"><?= $translations['size_medium'] ?? 'Medium (800px)' ?></option>
                            <option value="small"><?= $translations['size_small'] ?? 'Small (400px)' ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="downloadFormat" class="form-label"><?= $translations['image_format'] ?? 'Format' ?></label>
                        <select class="form-select" id="downloadFormat">
                            <option value="jpg">JPG</option>
                            <option value="png">PNG</option>
                            <option value="webp">WebP</option>
                        </select>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="downloadConsent" required>
                        <label class="form-check-label small" for="downloadConsent">
                            <?= $translations['download_consent'] ?? 'I agree to use this image only for personal/non-commercial purposes' ?>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-download me-2"></i>
                        <?= $translations['download_now'] ?? 'Download Now' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<!-- Gallery JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentCategory = 'all';
    let currentSearch = '';
    let currentSort = 'newest';
    let currentPage = 1;
    let itemsPerPage = 12;
    let allGalleryItems = [];
    let filteredItems = [];
    let currentLightboxIndex = 0;
    
    // Get all gallery items
    const galleryItems = document.querySelectorAll('.gallery-item');
    allGalleryItems = Array.from(galleryItems);
    
    // Hide loading initially
    document.getElementById('galleryLoading').style.display = 'none';
    
    // Category filter buttons
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Get category
            currentCategory = this.getAttribute('data-category');
            currentPage = 1;
            
            // Filter items
            filterGallery();
            
            // Update active filters display
            updateActiveFilters();
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    
    searchInput.addEventListener('input', function() {
        currentSearch = this.value.toLowerCase().trim();
        currentPage = 1;
        filterGallery();
        updateActiveFilters();
    });
    
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        currentSearch = '';
        currentPage = 1;
        filterGallery();
        updateActiveFilters();
    });
    
    // Sort functionality
    const sortSelect = document.getElementById('sortSelect');
    sortSelect.addEventListener('change', function() {
        currentSort = this.value;
        currentPage = 1;
        filterGallery();
        updateActiveFilters();
    });
    
    // Load more functionality
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    loadMoreBtn.addEventListener('click', function() {
        currentPage++;
        displayItems();
    });
    
    // View category from highlights
    document.querySelectorAll('.view-category').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            
            // Set category filter
            document.querySelectorAll('.category-btn').forEach(b => {
                b.classList.remove('active');
                if (b.getAttribute('data-category') === category) {
                    b.classList.add('active');
                }
            });
            
            currentCategory = category;
            currentPage = 1;
            filterGallery();
            updateActiveFilters();
            
            // Scroll to gallery
            document.querySelector('.gallery-grid').scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // View image in lightbox
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const imageUrl = this.getAttribute('data-image');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const category = this.getAttribute('data-category');
            
            // Find index in filtered items
            currentLightboxIndex = filteredItems.findIndex(item => 
                item.querySelector('img').getAttribute('src') === imageUrl);
            
            // Open lightbox
            openLightbox(imageUrl, title, description, category);
        });
    });
    
    // Download button
    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const imageUrl = this.getAttribute('data-image');
            const title = this.getAttribute('data-title');
            
            openDownloadModal(imageUrl, title);
        });
    });
    
    // Lightbox navigation
    document.getElementById('lightboxPrev').addEventListener('click', navigateLightbox.bind(null, -1));
    document.getElementById('lightboxNext').addEventListener('click', navigateLightbox.bind(null, 1));
    document.getElementById('lightboxDownload').addEventListener('click', downloadFromLightbox);
    
    // Download form submission
    document.getElementById('downloadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const downloadModal = bootstrap.Modal.getInstance(document.getElementById('downloadModal'));
        downloadModal.hide();
        
        // Show success message
        alert('<?= $translations["download_success"] ?? "Download started! Thank you for your interest in our gallery." ?>');
    });
    
    // Keyboard navigation for lightbox
    document.addEventListener('keydown', function(e) {
        const lightbox = bootstrap.Modal.getInstance(document.getElementById('imageLightbox'));
        if (lightbox && lightbox._isShown) {
            if (e.key === 'ArrowLeft') {
                navigateLightbox(-1);
            } else if (e.key === 'ArrowRight') {
                navigateLightbox(1);
            } else if (e.key === 'Escape') {
                lightbox.hide();
            } else if (e.key === 'd' || e.key === 'D') {
                downloadFromLightbox();
            }
        }
    });
    
    // Filter gallery function
    function filterGallery() {
        filteredItems = allGalleryItems.filter(item => {
            // Category filter
            if (currentCategory !== 'all') {
                const itemCategory = item.getAttribute('data-category');
                if (itemCategory !== currentCategory) {
                    return false;
                }
            }
            
            // Search filter
            if (currentSearch) {
                const itemTitle = item.getAttribute('data-title');
                if (!itemTitle.includes(currentSearch)) {
                    return false;
                }
            }
            
            return true;
        });
        
        // Sort items
        sortItems();
        
        // Display items
        displayItems();
    }
    
    // Sort items function
    function sortItems() {
        filteredItems.sort((a, b) => {
            switch (currentSort) {
                case 'newest':
                    return b.getAttribute('data-date') - a.getAttribute('data-date');
                case 'oldest':
                    return a.getAttribute('data-date') - b.getAttribute('data-date');
                case 'name_asc':
                    return a.getAttribute('data-title').localeCompare(b.getAttribute('data-title'));
                case 'name_desc':
                    return b.getAttribute('data-title').localeCompare(a.getAttribute('data-title'));
                case 'category':
                    return a.getAttribute('data-category').localeCompare(b.getAttribute('data-category'));
                default:
                    return 0;
            }
        });
    }
    
    // Display items function
    function displayItems() {
        const container = document.getElementById('galleryContainer');
        const noResults = document.getElementById('noResults');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        
        // Clear container if first page
        if (currentPage === 1) {
            container.innerHTML = '';
        }
        
        // Calculate items to show
        const startIndex = 0;
        const endIndex = currentPage * itemsPerPage;
        const itemsToShow = filteredItems.slice(startIndex, endIndex);
        
        if (itemsToShow.length === 0) {
            container.style.display = 'none';
            noResults.classList.remove('d-none');
            loadMoreContainer.style.display = 'none';
            return;
        }
        
        container.style.display = 'flex';
        noResults.classList.add('d-none');
        
        // Add items to container (only if first page)
        if (currentPage === 1) {
            itemsToShow.forEach(item => {
                container.appendChild(item);
            });
        } else {
            // For subsequent pages, we need to re-add all items
            container.innerHTML = '';
            itemsToShow.forEach(item => {
                container.appendChild(item);
            });
        }
        
        // Show/hide load more button
        if (endIndex >= filteredItems.length) {
            loadMoreContainer.style.display = 'none';
        } else {
            loadMoreContainer.style.display = 'block';
        }
        
        // Reattach event listeners for new items
        reattachEventListeners();
    }
    
    // Update active filters display
    function updateActiveFilters() {
        const activeFilters = document.getElementById('activeFilters');
        let filtersHtml = '';
        
        if (currentCategory !== 'all') {
            const categoryLabel = document.querySelector(`.category-btn[data-category="${currentCategory}"]`).textContent;
            filtersHtml += `<span class="badge bg-primary me-2 mb-2">Category: ${categoryLabel}</span>`;
        }
        
        if (currentSearch) {
            filtersHtml += `<span class="badge bg-info me-2 mb-2">Search: "${currentSearch}"</span>`;
        }
        
        if (currentSort !== 'newest') {
            const sortLabel = sortSelect.options[sortSelect.selectedIndex].text;
            filtersHtml += `<span class="badge bg-warning me-2 mb-2">Sorted: ${sortLabel}</span>`;
        }
        
        if (filtersHtml) {
            filtersHtml = `<strong class="me-2">Active Filters:</strong> ${filtersHtml}`;
            filtersHtml += `<button class="btn btn-sm btn-outline-secondary ms-2 mb-2" id="clearFilters">
                <i class="fas fa-times me-1"></i> Clear All
            </button>`;
        }
        
        activeFilters.innerHTML = filtersHtml;
        
        // Add clear filters button event
        const clearFiltersBtn = document.getElementById('clearFilters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', clearAllFilters);
        }
    }
    
    // Clear all filters
    function clearAllFilters() {
        // Reset category
        document.querySelectorAll('.category-btn').forEach(b => {
            b.classList.remove('active');
            if (b.getAttribute('data-category') === 'all') {
                b.classList.add('active');
            }
        });
        currentCategory = 'all';
        
        // Reset search
        searchInput.value = '';
        currentSearch = '';
        
        // Reset sort
        sortSelect.value = 'newest';
        currentSort = 'newest';
        
        // Reset page
        currentPage = 1;
        
        // Refresh gallery
        filterGallery();
        updateActiveFilters();
    }
    
    // Open lightbox
    function openLightbox(imageUrl, title, description, category) {
        const lightbox = new bootstrap.Modal(document.getElementById('imageLightbox'));
        
        // Set content
        document.getElementById('lightboxTitle').textContent = title;
        document.getElementById('lightboxCategory').textContent = category;
        document.getElementById('lightboxImage').src = imageUrl;
        document.getElementById('lightboxImage').alt = title;
        document.getElementById('lightboxDescription').textContent = description;
        
        // Simulate image dimensions
        const dimensions = `${Math.floor(Math.random() * 2000) + 1000} × ${Math.floor(Math.random() * 1500) + 800}`;
        document.getElementById('lightboxDimensions').textContent = dimensions + ' px';
        
        lightbox.show();
    }
    
    // Navigate lightbox
    function navigateLightbox(direction) {
        if (filteredItems.length === 0) return;
        
        currentLightboxIndex += direction;
        
        // Loop around
        if (currentLightboxIndex < 0) {
            currentLightboxIndex = filteredItems.length - 1;
        } else if (currentLightboxIndex >= filteredItems.length) {
            currentLightboxIndex = 0;
        }
        
        const item = filteredItems[currentLightboxIndex];
        const imageUrl = item.querySelector('img').getAttribute('src');
        const title = item.getAttribute('data-title');
        const description = item.querySelector('.gallery-info p').textContent;
        const category = item.getAttribute('data-category');
        
        openLightbox(imageUrl, title, description, category);
    }
    
    // Open download modal
    function openDownloadModal(imageUrl, title) {
        const downloadModal = new bootstrap.Modal(document.getElementById('downloadModal'));
        
        // Set content
        document.getElementById('downloadPreview').src = imageUrl;
        document.getElementById('downloadPreview').alt = title;
        document.getElementById('downloadName').value = title.replace(/\s+/g, '_').toLowerCase();
        
        downloadModal.show();
    }
    
    // Download from lightbox
    function downloadFromLightbox() {
        const imageUrl = document.getElementById('lightboxImage').src;
        const title = document.getElementById('lightboxTitle').textContent;
        
        openDownloadModal(imageUrl, title);
    }
    
    // Reattach event listeners after DOM changes
    function reattachEventListeners() {
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                const category = this.getAttribute('data-category');
                
                currentLightboxIndex = filteredItems.findIndex(item => 
                    item.querySelector('img').getAttribute('src') === imageUrl);
                
                openLightbox(imageUrl, title, description, category);
            });
        });
        
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const imageUrl = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                
                openDownloadModal(imageUrl, title);
            });
        });
    }
    
    // Initialize
    filterGallery();
    updateActiveFilters();
});
</script>

<style>
/* Gallery Page Specific Styles */
.gallery-hero {
    background: linear-gradient(135deg, #F8F4E9 0%, #FFFFFF 100%);
}

.gallery-hero-image img {
    border-radius: 10px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.gallery-hero-image img:hover {
    transform: scale(1.02);
}

.gallery-stats {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.gallery-stats .stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.gallery-stats .stat-item p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0;
}

/* Gallery Controls */
.search-box .input-group {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.search-box .input-group-text {
    border-right: none;
}

.search-box .form-control {
    border-left: none;
}

.search-box .form-control:focus {
    box-shadow: none;
}

.category-filter .btn-group {
    flex-wrap: wrap;
    gap: 8px;
}

.category-filter .btn {
    border-radius: 8px !important;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.category-filter .btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.category-filter .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.category-filter .badge {
    font-size: 0.7rem;
    padding: 2px 6px;
}

.sort-options .form-select {
    border-radius: 8px;
    padding: 8px 16px;
    border-color: #dee2e6;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.sort-options .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(139, 115, 85, 0.25);
}

.active-filters {
    min-height: 40px;
}

.active-filters .badge {
    font-size: 0.85rem;
    padding: 6px 12px;
    display: inline-flex;
    align-items: center;
}

/* Gallery Grid */
.gallery-grid .row {
    display: flex;
    flex-wrap: wrap;
}

.gallery-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.gallery-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-card:hover .gallery-image img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-info h6 {
    color: white;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.gallery-info p {
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.gallery-info .badge {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
}

.gallery-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

.gallery-actions .btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.9);
    color: var(--dark-color);
    border: none;
    transition: all 0.3s ease;
}

.gallery-actions .btn:hover {
    background: white;
    color: var(--primary-color);
    transform: scale(1.1);
}

/* Category Highlights */
.category-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.category-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    padding: 20px;
    text-align: center;
}

.category-overlay h5 {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.category-overlay p {
    font-size: 0.9rem;
    opacity: 0.8;
}

.category-overlay .btn {
    margin-top: 10px;
    padding: 5px 15px;
    font-size: 0.85rem;
}

/* Lightbox */
#imageLightbox .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.lightbox-image-container {
    max-height: 70vh;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
}

.lightbox-image-container img {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
}

.lightbox-info {
    background: white;
}

.lightbox-actions {
    display: flex;
    gap: 10px;
}

.lightbox-actions .btn {
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Download Modal */
#downloadModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.download-preview {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 20px;
    background: #f8f9fa;
}

/* Loading Animation */
.gallery-loading {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-stats {
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }
    
    .gallery-stats .stat-item {
        flex: 0 0 calc(50% - 1rem);
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .category-filter .btn {
        flex: 0 0 calc(50% - 8px);
        justify-content: center;
        margin-bottom: 8px;
    }
    
    .gallery-image {
        height: 200px;
    }
    
    .category-image {
        height: 150px;
    }
    
    .lightbox-actions {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .lightbox-actions .btn {
        margin-bottom: 5px;
    }
}

@media (max-width: 576px) {
    .gallery-stats .stat-item {
        flex: 0 0 100%;
    }
    
    .category-filter .btn {
        flex: 0 0 100%;
    }
    
    .gallery-item {
        margin-bottom: 1.5rem;
    }
    
    .category-card {
        margin-bottom: 1.5rem;
    }
}
</style>