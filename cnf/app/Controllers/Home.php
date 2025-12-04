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
}