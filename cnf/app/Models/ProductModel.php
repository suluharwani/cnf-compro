<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'product_code', 'category', 'subcategory', 'price', 'discount_price',
        'is_featured', 'is_bestseller', 'is_new', 'stock_status', 'material',
        'dimensions', 'weight', 'image_url', 'image_url_2', 'image_url_3',
        'is_active', 'display_order'
    ];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getFeaturedProducts($languageCode = 'en', $limit = 6)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('products p')
            ->select('p.*, pt.name, pt.short_description, pt.description')
            ->join('product_translations pt', 
                   "p.id = pt.product_id AND pt.language_id = $languageId", 
                   'left')
            ->where('p.is_featured', 1)
            ->where('p.is_active', 1)
            ->orderBy('p.display_order', 'ASC')
            ->orderBy('p.created_at', 'DESC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
    
    public function getProductsByCategory($category, $languageCode = 'en', $limit = null)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $builder = $this->db->table('products p')
            ->select('p.*, pt.name, pt.short_description, pt.description')
            ->join('product_translations pt', 
                   "p.id = pt.product_id AND pt.language_id = $languageId", 
                   'left')
            ->where('p.category', $category)
            ->where('p.is_active', 1)
            ->orderBy('p.display_order', 'ASC')
            ->orderBy('p.created_at', 'DESC');
            
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->get()->getResultArray();
    }
    
    public function getProductByCode($productCode, $languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('products p')
            ->select('p.*, pt.name, pt.description, pt.short_description, pt.specifications, pt.features')
            ->join('product_translations pt', 
                   "p.id = pt.product_id AND pt.language_id = $languageId", 
                   'left')
            ->where('p.product_code', $productCode)
            ->where('p.is_active', 1)
            ->get();
        
        return $query->getRowArray();
    }
    
    public function getNewArrivals($languageCode = 'en', $limit = 4)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('products p')
            ->select('p.*, pt.name, pt.short_description')
            ->join('product_translations pt', 
                   "p.id = pt.product_id AND pt.language_id = $languageId", 
                   'left')
            ->where('p.is_new', 1)
            ->where('p.is_active', 1)
            ->orderBy('p.created_at', 'DESC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
    
    public function getBestsellers($languageCode = 'en', $limit = 4)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('products p')
            ->select('p.*, pt.name, pt.short_description')
            ->join('product_translations pt', 
                   "p.id = pt.product_id AND pt.language_id = $languageId", 
                   'left')
            ->where('p.is_bestseller', 1)
            ->where('p.is_active', 1)
            ->orderBy('p.display_order', 'ASC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
}