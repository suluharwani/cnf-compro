<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LanguageModel;
use App\Models\TranslationModel;
use App\Models\CompanyInfoModel;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form'];
    protected $session;
    protected $currentLang;
    protected $translations = [];
    protected $companyInfo = [];
    protected $languageModel;
    protected $translationModel;
    protected $companyInfoModel;
    
    public function __construct()
    {
        // Tidak perlu panggil parent::__construct() karena Controller tidak punya constructor
        $this->session = \Config\Services::session();
        $this->languageModel = new LanguageModel();
        $this->translationModel = new TranslationModel();
        $this->companyInfoModel = new CompanyInfoModel();
    }
    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        // Set default language
        if (!$this->session->get('language')) {
            $this->session->set('language', 'en');
        }
        
        $this->currentLang = $this->session->get('language');
        
        // Load translations
        $this->loadTranslations();
        
        // Load company info
        $this->loadCompanyInfo();
    }
    
    protected function loadTranslations()
    {
        $cache = \Config\Services::cache();
        $cacheKey = "translations_{$this->currentLang}";
        
        $this->translations = $cache->get($cacheKey);
        
        if (!$this->translations) {
            $this->translations = $this->translationModel->getAllTranslations($this->currentLang);
            
            // Cache for 1 hour
            $cache->save($cacheKey, $this->translations, 3600);
        }
    }
    
    protected function loadCompanyInfo()
    {
        $cache = \Config\Services::cache();
        $cacheKey = "company_info_{$this->currentLang}";
        
        $this->companyInfo = $cache->get($cacheKey);
        
        if (!$this->companyInfo) {
            $this->companyInfo = $this->companyInfoModel->getCompanyInfo($this->currentLang);
            
            // Cache for 1 hour
            $cache->save($cacheKey, $this->companyInfo, 3600);
        }
    }
    
    protected function getTrans($key)
    {
        return $this->translations[$key] ?? $key;
    }
    
    protected function getCompanyInfo($key)
    {
        return $this->companyInfo[$key] ?? '';
    }
}