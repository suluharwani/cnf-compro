<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['slug', 'parent_id', 'icon', 'is_active', 'display_order'];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getActiveCategories($languageCode = 'en', $parentId = null)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $builder = $this->db->table('categories c')
            ->select('c.*, ct.name, ct.description')
            ->join('category_translations ct', 
                   "c.id = ct.category_id AND ct.language_id = $languageId", 
                   'left')
            ->where('c.is_active', 1);
            
        if ($parentId !== null) {
            $builder->where('c.parent_id', $parentId);
        } else {
            $builder->where('c.parent_id IS NULL');
        }
        
        return $builder->orderBy('c.display_order', 'ASC')
                      ->orderBy('c.id', 'ASC')
                      ->get()
                      ->getResultArray();
    }
    
    public function getCategoryBySlug($slug, $languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('categories c')
            ->select('c.*, ct.name, ct.description')
            ->join('category_translations ct', 
                   "c.id = ct.category_id AND ct.language_id = $languageId", 
                   'left')
            ->where('c.slug', $slug)
            ->where('c.is_active', 1)
            ->get();
        
        return $query->getRowArray();
    }
}