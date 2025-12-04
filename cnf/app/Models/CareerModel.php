<?php

namespace App\Models;

use CodeIgniter\Model;

class CareerModel extends Model
{
    protected $table = 'careers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'job_code', 'department', 'location', 'employment_type', 
        'experience_level', 'salary_range', 'vacancies', 'is_active', 
        'is_urgent', 'posted_date', 'deadline_date'
    ];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getActiveCareers($languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            $languageId = $languageModel->getLanguageIdByCode('en');
        }
        
        $query = $this->db->table('careers c')
            ->select('c.*, ct.title, ct.description, ct.requirements, ct.benefits')
            ->join('career_translations ct', 
                   "c.id = ct.career_id AND ct.language_id = $languageId", 
                   'left')
            ->where('c.is_active', 1)
            ->where('(c.deadline_date IS NULL OR c.deadline_date >= CURDATE())')
            ->orderBy('c.is_urgent', 'DESC')
            ->orderBy('c.posted_date', 'DESC')
            ->get();
        
        return $query->getResultArray();
    }
}