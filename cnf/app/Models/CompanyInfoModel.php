<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyInfoModel extends Model
{
    protected $table = 'company_info';
    protected $primaryKey = 'id';
    protected $allowedFields = ['info_key', 'info_value', 'info_type'];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getCompanyInfo($languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            // Fallback to English
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('company_info ci')
            ->select('ci.info_key, 
                     COALESCE(cit.translated_value, ci.info_value) as info_value,
                     ci.info_type')
            ->join('company_info_translations cit', 
                   "ci.id = cit.company_info_id AND cit.language_id = $languageId", 
                   'left')
            ->orderBy('ci.info_key', 'ASC')
            ->get();
        
        $info = [];
        foreach ($query->getResultArray() as $row) {
            $info[$row['info_key']] = $row['info_value'];
        }
        
        return $info;
    }
    
    public function getCompanyInfoByKey($key, $languageCode = 'en')
    {
        $info = $this->getCompanyInfo($languageCode);
        return $info[$key] ?? null;
    }
}