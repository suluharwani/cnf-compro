<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'gallery_type', 'image_url', 'thumbnail_url', 'title', 
        'display_order', 'is_active'
    ];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getGalleryByType($type, $languageCode = 'en', $limit = 12)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('galleries g')
            ->select('g.*, gt.title as gallery_title, gt.description, gt.alt_text')
            ->join('gallery_translations gt', 
                   "g.id = gt.gallery_id AND gt.language_id = $languageId", 
                   'left')
            ->where('g.gallery_type', $type)
            ->where('g.is_active', 1)
            ->orderBy('g.display_order', 'ASC')
            ->orderBy('g.created_at', 'DESC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
    
    public function getFeaturedGallery($languageCode = 'en', $limit = 8)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('galleries g')
            ->select('g.*, gt.title as gallery_title, gt.description, gt.alt_text')
            ->join('gallery_translations gt', 
                   "g.id = gt.gallery_id AND gt.language_id = $languageId", 
                   'left')
            ->where('g.is_active', 1)
            ->orderBy('g.display_order', 'ASC')
            ->orderBy('g.created_at', 'DESC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
}