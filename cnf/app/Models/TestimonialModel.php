<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'client_name', 'client_title', 'client_company', 'client_image',
        'rating', 'project_type', 'project_date', 'is_featured', 
        'is_active', 'display_order'
    ];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getFeaturedTestimonials($languageCode = 'en', $limit = 5)
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('testimonials t')
            ->select('t.*, tt.testimonial_text')
            ->join('testimonial_translations tt', 
                   "t.id = tt.testimonial_id AND tt.language_id = $languageId", 
                   'left')
            ->where('t.is_featured', 1)
            ->where('t.is_active', 1)
            ->orderBy('t.display_order', 'ASC')
            ->orderBy('t.created_at', 'DESC')
            ->limit($limit)
            ->get();
        
        return $query->getResultArray();
    }
}