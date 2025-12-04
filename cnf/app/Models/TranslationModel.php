<?php

namespace App\Models;

use CodeIgniter\Model;

class TranslationModel extends Model
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['content_key_id', 'language_id', 'translation_text'];
    protected $useTimestamps = true;
    
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getAllTranslations($languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            return [];
        }
        
        $query = $this->db->table('translations t')
            ->select('ck.key_name, t.translation_text')
            ->join('content_keys ck', 'ck.id = t.content_key_id')
            ->where('t.language_id', $languageId)
            ->orderBy('ck.category', 'ASC')
            ->orderBy('ck.key_name', 'ASC')
            ->get();
        
        $translations = [];
        foreach ($query->getResultArray() as $row) {
            $translations[$row['key_name']] = $row['translation_text'];
        }
        
        return $translations;
    }
    
    public function getTranslation($key, $languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            return $key;
        }
        
        $query = $this->db->table('translations t')
            ->select('t.translation_text')
            ->join('content_keys ck', 'ck.id = t.content_key_id')
            ->where('ck.key_name', $key)
            ->where('t.language_id', $languageId)
            ->get();
        
        $result = $query->getRowArray();
        
        return $result ? $result['translation_text'] : $key;
    }
    
    public function getTranslationsByCategory($category, $languageCode = 'en')
    {
        $languageModel = new LanguageModel();
        $languageId = $languageModel->getLanguageIdByCode($languageCode);
        
        if (!$languageId) {
            return [];
        }
        
        $query = $this->db->table('translations t')
            ->select('ck.key_name, t.translation_text')
            ->join('content_keys ck', 'ck.id = t.content_key_id')
            ->where('ck.category', $category)
            ->where('t.language_id', $languageId)
            ->orderBy('ck.key_name', 'ASC')
            ->get();
        
        $translations = [];
        foreach ($query->getResultArray() as $row) {
            $translations[$row['key_name']] = $row['translation_text'];
        }
        
        return $translations;
    }
}