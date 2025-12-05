<?php

namespace App\Controllers;

use App\Models\LanguageModel;
use App\Models\TranslationModel;
use App\Models\CompanyInfoModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\GalleryModel;
use App\Models\ServiceModel;
use App\Models\TestimonialModel;
use App\Models\CareerModel;
use App\Models\SettingsModel;

class Home extends BaseController
{
    protected $session;
    protected $currentLang;
    protected $translations = [];
    protected $companyInfo = [];
    protected $settings = [];
    
    // Models
    protected $languageModel;
    protected $translationModel;
    protected $companyInfoModel;
    protected $productModel;
    protected $categoryModel;
    protected $galleryModel;
    protected $serviceModel;
    protected $testimonialModel;
    protected $careerModel;
    protected $settingsModel;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        
        // Initialize models
        $this->languageModel = new LanguageModel();
        $this->translationModel = new TranslationModel();
        $this->companyInfoModel = new CompanyInfoModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->galleryModel = new GalleryModel();
        $this->serviceModel = new ServiceModel();
        $this->testimonialModel = new TestimonialModel();
        $this->careerModel = new CareerModel();
        $this->settingsModel = new SettingsModel();
        
        // Set default language
        if (!$this->session->get('language')) {
            $this->session->set('language', 'en');
        }
        
        $this->currentLang = $this->session->get('language');
        
        // Load data from database
        $this->loadDataFromDatabase();
    }
    
    protected function loadDataFromDatabase()
    {
        // Load translations
        $this->translations = $this->translationModel->getAllTranslations($this->currentLang);
        
        // Load company info
        $this->companyInfo = $this->companyInfoModel->getCompanyInfo($this->currentLang);
        
        // Load settings
        $this->settings = $this->settingsModel->getSettingsByCategory('general');
    }
    
    public function index()
    {
        // Get all data from database
        $data = [
            'title' => ($this->translations['site_title'] ?? 'PT Chakra Naga Furniture') . ' - ' . ($this->companyInfo['company_name'] ?? 'Furniture Manufacturer'),
            'activePage' => 'home',
            'currentLang' => $this->currentLang,
            'translations' => $this->translations,
            'companyInfo' => $this->companyInfo,
            
            // Products data
            'featuredProducts' => $this->productModel->getFeaturedProducts($this->currentLang, 6),
            'newArrivals' => $this->productModel->getNewArrivals($this->currentLang, 4),
            'bestsellers' => $this->productModel->getBestsellers($this->currentLang, 4),
            'upholsteryProducts' => $this->productModel->getProductsByCategory('upholstery', $this->currentLang, 4),
            'furnitureProducts' => $this->productModel->getProductsByCategory('furniture', $this->currentLang, 4),
            
            // Categories
            'categories' => $this->categoryModel->getActiveCategories($this->currentLang),
            
            // Gallery
            'gallery' => $this->galleryModel->getFeaturedGallery($this->currentLang, 8),
            
            // Services
            'services' => $this->serviceModel->getActiveServices($this->currentLang),
            
            // Testimonials
            'testimonials' => $this->testimonialModel->getFeaturedTestimonials($this->currentLang, 5),
            
            // Statistics from company info
            'stats' => [
                'years' => $this->companyInfo['years_experience'] ?? '19+',
                'projects' => $this->companyInfo['projects_completed'] ?? '5000+',
                'clients' => $this->companyInfo['happy_clients'] ?? '2000+',
                'countries' => $this->companyInfo['countries_served'] ?? '15+'
            ]
        ];
        
        return view('home', $data);
    }
    
    public function career()
    {
        $data = [
            'title' => ($this->translations['nav_career'] ?? 'Career') . ' - ' . ($this->companyInfo['company_name'] ?? 'PT Chakra Naga Furniture'),
            'activePage' => 'career',
            'currentLang' => $this->currentLang,
            'translations' => $this->translations,
            'companyInfo' => $this->companyInfo,
            'careers' => $this->careerModel->getActiveCareers($this->currentLang)
        ];

        return view('career', $data);
    }
    
    public function switchLanguage($lang = 'en')
    {
        // Validate language exists in database
        $language = $this->languageModel->getLanguageByCode($lang);
        
        if ($language && $language['is_active']) {
            $this->session->set('language', $lang);
        } else {
            // Fallback to English
            $this->session->set('language', 'en');
        }
        
        return redirect()->back();
    }
    
    public function downloadCatalog()
    {
        // Get catalog from database (assuming catalog file info is stored)
        $filePath = ROOTPATH . 'public/assets/catalog/chakra-naga-catalog-2024.pdf';
        
        if (file_exists($filePath)) {
            // Increment download count (if tracking in database)
            return $this->response->download($filePath, null);
        }
        
        return redirect()->back()->with('error', 'Catalog not found');
    }
    
    public function contact()
    {
        if ($this->request->getMethod() === 'post') {
            // Handle contact form submission
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
                'ip_address' => $this->request->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // Save to database (create a contact_messages table if needed)
            // For now, just show success message
            
            return redirect()->back()->with('success', 'Thank you for your message! We will contact you soon.');
        }
        
        $data = [
            'title' => ($this->translations['nav_contact'] ?? 'Contact Us') . ' - ' . ($this->companyInfo['company_name'] ?? 'PT Chakra Naga Furniture'),
            'activePage' => 'contact',
            'currentLang' => $this->currentLang,
            'translations' => $this->translations,
            'companyInfo' => $this->companyInfo
        ];
        
        return view('contact', $data);
    }
    
    public function products($category = null)
    {
        $products = [];
        $categoryInfo = null;
        
        if ($category) {
            $categoryInfo = $this->categoryModel->getCategoryBySlug($category, $this->currentLang);
            if ($categoryInfo) {
                $products = $this->productModel->getProductsByCategory($categoryInfo['slug'], $this->currentLang);
            }
        } else {
            $products = $this->productModel->getFeaturedProducts($this->currentLang, 20);
        }
        
        $data = [
            'title' => ($categoryInfo['name'] ?? ($this->translations['nav_products'] ?? 'Products')) . ' - ' . ($this->companyInfo['company_name'] ?? 'PT Chakra Naga Furniture'),
            'activePage' => 'products',
            'currentLang' => $this->currentLang,
            'translations' => $this->translations,
            'companyInfo' => $this->companyInfo,
            'products' => $products,
            'category' => $categoryInfo,
            'categories' => $this->categoryModel->getActiveCategories($this->currentLang)
        ];
        
        return view('products', $data);
    }
    
    public function productDetail($productCode)
    {
        $product = $this->productModel->getProductByCode($productCode, $this->currentLang);
        
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found');
        }
        
        $data = [
            'title' => ($product['name'] ?? 'Product') . ' - ' . ($this->companyInfo['company_name'] ?? 'PT Chakra Naga Furniture'),
            'activePage' => 'products',
            'currentLang' => $this->currentLang,
            'translations' => $this->translations,
            'companyInfo' => $this->companyInfo,
            'product' => $product,
            'relatedProducts' => $this->productModel->getProductsByCategory($product['category'], $this->currentLang, 4)
        ];
        
        return view('product_detail', $data);
    }
    public function about()
{
    // Get about page data
    $aboutData = [
        'story' => $this->translationModel->getTranslation('about_story', $this->currentLang),
        'history_timeline' => $this->getAboutTimeline($this->currentLang),
        'mission' => $this->translationModel->getTranslation('about_mission', $this->currentLang),
        'vision' => $this->translationModel->getTranslation('about_vision', $this->currentLang),
        'values' => $this->getAboutValues($this->currentLang),
        'team' => $this->getTeamMembers(),
        'certifications' => $this->getCertifications(),
        'facilities' => $this->getFacilities()
    ];
    
    $data = [
        'title' => $this->translations['about_title'] . ' - ' . $this->companyInfo['company_name'],
        'activePage' => 'about',
        'currentLang' => $this->currentLang,
        'translations' => $this->translations,
        'companyInfo' => $this->companyInfo,
        'aboutData' => $aboutData,
        'stats' => [
            'years' => $this->companyInfo['years_experience'] ?? '19+',
            'projects' => $this->companyInfo['projects_completed'] ?? '850+',
            'clients' => $this->companyInfo['happy_clients'] ?? '420+',
            'countries' => $this->companyInfo['countries_served'] ?? '12+'
        ]
    ];
    
    return view('about', $data);
}

private function getAboutTimeline($languageCode = 'en')
{
    // In production, this would come from database
    $timeline = [
        [
            'year' => '2005',
            'title' => $languageCode === 'id' ? 'Pendirian Perusahaan' : 'Company Foundation',
            'description' => $languageCode === 'id' ? 
                'PT Chakra Naga Furniture didirikan di Jepara dengan fokus pada furnitur kayu tradisional' : 
                'PT Chakra Naga Furniture was founded in Jepara with focus on traditional wooden furniture',
            'icon' => 'fas fa-building',
            'color' => 'primary'
        ],
        [
            'year' => '2008',
            'title' => $languageCode === 'id' ? 'Ekspansi ke Upholstery' : 'Expansion to Upholstery',
            'description' => $languageCode === 'id' ? 
                'Memperluas lini produk dengan menambahkan koleksi upholstery dan sofa' : 
                'Expanded product line by adding upholstery and sofa collections',
            'icon' => 'fas fa-couch',
            'color' => 'success'
        ],
        [
            'year' => '2012',
            'title' => $languageCode === 'id' ? 'Ekspor Internasional Pertama' : 'First International Export',
            'description' => $languageCode === 'id' ? 
                'Mengirimkan pengiriman pertama ke Singapura dan Malaysia' : 
                'Shipped first export orders to Singapore and Malaysia',
            'icon' => 'fas fa-plane',
            'color' => 'info'
        ],
        [
            'year' => '2015',
            'title' => $languageCode === 'id' ? 'Sertifikasi Kualitas' : 'Quality Certification',
            'description' => $languageCode === 'id' ? 
                'Mendapatkan sertifikasi SNI dan standar kualitas internasional' : 
                'Obtained SNI certification and international quality standards',
            'icon' => 'fas fa-award',
            'color' => 'warning'
        ],
        [
            'year' => '2018',
            'title' => $languageCode === 'id' ? 'Pabrik Baru' : 'New Factory',
            'description' => $languageCode === 'id' ? 
                'Pindah ke fasilitas produksi yang lebih besar di Suwawal, Jepara' : 
                'Moved to larger production facility in Suwawal, Jepara',
            'icon' => 'fas fa-industry',
            'color' => 'danger'
        ],
        [
            'year' => '2023',
            'title' => $languageCode === 'id' ? 'Digital Transformation' : 'Digital Transformation',
            'description' => $languageCode === 'id' ? 
                'Meluncurkan website dan sistem online untuk penjualan global' : 
                'Launched website and online system for global sales',
            'icon' => 'fas fa-globe',
            'color' => 'primary'
        ]
    ];
    
    return $timeline;
}

private function getAboutValues($languageCode = 'en')
{
    $values = [
        [
            'title' => $languageCode === 'id' ? 'Kualitas Terbaik' : 'Best Quality',
            'description' => $languageCode === 'id' ? 
                'Kami berkomitmen untuk menghadirkan produk dengan kualitas terbaik menggunakan material pilihan' : 
                'We are committed to delivering products with the best quality using premium materials',
            'icon' => 'fas fa-gem',
            'color' => 'primary'
        ],
        [
            'title' => $languageCode === 'id' ? 'Inovasi' : 'Innovation',
            'description' => $languageCode === 'id' ? 
                'Terus berinovasi dalam desain dan teknik produksi untuk memenuhi kebutuhan pasar' : 
                'Continuously innovate in design and production techniques to meet market needs',
            'icon' => 'fas fa-lightbulb',
            'color' => 'success'
        ],
        [
            'title' => $languageCode === 'id' ? 'Keberlanjutan' : 'Sustainability',
            'description' => $languageCode === 'id' ? 
                'Menggunakan kayu bersertifikat dan praktik produksi ramah lingkungan' : 
                'Using certified wood and environmentally friendly production practices',
            'icon' => 'fas fa-leaf',
            'color' => 'info'
        ],
        [
            'title' => $languageCode === 'id' ? 'Kepuasan Pelanggan' : 'Customer Satisfaction',
            'description' => $languageCode === 'id' ? 
                'Prioritas utama kami adalah kepuasan dan kepercayaan pelanggan' : 
                'Our top priority is customer satisfaction and trust',
            'icon' => 'fas fa-heart',
            'color' => 'danger'
        ],
        [
            'title' => $languageCode === 'id' ? 'Kerajinan Tradisional' : 'Traditional Craftsmanship',
            'description' => $languageCode === 'id' ? 
                'Mempertahankan keahlian kerajinan tangan tradisional Jepara' : 
                'Preserving traditional Jepara handcrafting skills',
            'icon' => 'fas fa-hands',
            'color' => 'warning'
        ],
        [
            'title' => $languageCode === 'id' ? 'Integritas' : 'Integrity',
            'description' => $languageCode === 'id' ? 
                'Berbisnis dengan jujur dan transparan dalam semua aspek' : 
                'Conducting business with honesty and transparency in all aspects',
            'icon' => 'fas fa-handshake',
            'color' => 'secondary'
        ]
    ];
    
    return $values;
}

private function getTeamMembers()
{
    // In production, this would come from database
    return [
        [
            'name' => 'Luqi',
            'position' => 'Founder & CEO',
            'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'bio' => 'Pendiri PT Chakra Naga Furniture dengan pengalaman 20 tahun di industri furnitur Jepara',
            'social' => ['linkedin', 'email']
        ],
        [
            'name' => 'Sari Dewi',
            'position' => 'Design Director',
            'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'bio' => 'Desainer berpengalaman dengan spesialisasi dalam furnitur modern dan tradisional',
            'social' => ['linkedin', 'instagram']
        ],
        [
            'name' => 'Budi Santoso',
            'position' => 'Production Manager',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'bio' => 'Ahli produksi dengan keahlian dalam manajemen kualitas dan efisiensi produksi',
            'social' => ['linkedin']
        ],
        [
            'name' => 'Maya Indah',
            'position' => 'Sales Director',
            'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'bio' => 'Spesialis penjualan internasional dengan jaringan klien di 12 negara',
            'social' => ['linkedin', 'whatsapp']
        ]
    ];
}

private function getCertifications()
{
    return [
        [
            'name' => 'SNI Certification',
            'description' => 'Indonesian National Standard for Furniture',
            'icon' => 'fas fa-certificate'
        ],
        [
            'name' => 'FSC Certified',
            'description' => 'Forest Stewardship Council - Sustainable Wood',
            'icon' => 'fas fa-tree'
        ],
        [
            'name' => 'ISO 9001:2015',
            'description' => 'Quality Management System',
            'icon' => 'fas fa-award'
        ],
        [
            'name' => 'Export License',
            'description' => 'Registered International Exporter',
            'icon' => 'fas fa-globe'
        ]
    ];
}

private function getFacilities()
{
    return [
        [
            'name' => 'Production Workshop',
            'image' => 'https://images.unsplash.com/photo-1581235720706-9856d6d1b7b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'description' => 'Modern production facility with traditional craftsmanship'
        ],
        [
            'name' => 'Quality Control Lab',
            'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'description' => 'State-of-the-art quality testing equipment'
        ],
        [
            'name' => 'Showroom',
            'image' => 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'description' => 'Product display and customer consultation area'
        ],
        [
            'name' => 'Warehouse',
            'image' => 'https://images.unsplash.com/photo-1563291074-2bf8677ac0e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'description' => 'Secure storage and packaging facility'
        ]
    ];
}
public function gallery()
{
    // Get all gallery categories
    $galleryTypes = $this->getGalleryTypes();
    
    // Get gallery items
    $galleryItems = $this->galleryModel->getFeaturedGallery($this->currentLang, 50);
    
    // Group by category for filter
    $groupedGallery = [];
    foreach ($galleryItems as $item) {
        if (!isset($groupedGallery[$item['gallery_type']])) {
            $groupedGallery[$item['gallery_type']] = [];
        }
        $groupedGallery[$item['gallery_type']][] = $item;
    }
    
    $data = [
        'title' =>  $this->companyInfo['company_name'],
        'activePage' => 'gallery',
        'currentLang' => $this->currentLang,
        'translations' => $this->translations,
        'companyInfo' => $this->companyInfo,
        'galleryTypes' => $galleryTypes,
        'galleryItems' => $galleryItems,
        'groupedGallery' => $groupedGallery,
        'totalItems' => count($galleryItems)
    ];
    
    return view('gallery', $data);
}

private function getGalleryTypes()
{
    // In production, get from database
    return [
        [
            'value' => 'all',
            'label' => $this->currentLang === 'id' ? 'Semua Kategori' : 'All Categories',
            'icon' => 'fas fa-th',
            'count' => count($this->galleryModel->getFeaturedGallery($this->currentLang, 1000))
        ],
        [
            'value' => 'product',
            'label' => $this->currentLang === 'id' ? 'Produk' : 'Products',
            'icon' => 'fas fa-couch',
            'count' => count(array_filter($this->galleryModel->getFeaturedGallery($this->currentLang, 1000), 
                fn($item) => $item['gallery_type'] === 'product'))
        ],
        [
            'value' => 'showroom',
            'label' => $this->currentLang === 'id' ? 'Showroom' : 'Showroom',
            'icon' => 'fas fa-store',
            'count' => count(array_filter($this->galleryModel->getFeaturedGallery($this->currentLang, 1000), 
                fn($item) => $item['gallery_type'] === 'showroom'))
        ],
        [
            'value' => 'workshop',
            'label' => $this->currentLang === 'id' ? 'Workshop' : 'Workshop',
            'icon' => 'fas fa-tools',
            'count' => count(array_filter($this->galleryModel->getFeaturedGallery($this->currentLang, 1000), 
                fn($item) => $item['gallery_type'] === 'workshop'))
        ],
        [
            'value' => 'project',
            'label' => $this->currentLang === 'id' ? 'Proyek' : 'Projects',
            'icon' => 'fas fa-project-diagram',
            'count' => count(array_filter($this->galleryModel->getFeaturedGallery($this->currentLang, 1000), 
                fn($item) => $item['gallery_type'] === 'project'))
        ]
    ];
}
}