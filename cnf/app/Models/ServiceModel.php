<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icon', 'service_order', 'is_active'];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getActiveServices($languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('services s')
            ->select('s.*, st.title, st.description')
            ->join('service_translations st', 
                   "s.id = st.service_id AND st.language_id = $languageId", 
                   'left')
            ->where('s.is_active', 1)
            ->orderBy('s.service_order', 'ASC')
            ->get();
        
        return $query->getResultArray();
    }
}