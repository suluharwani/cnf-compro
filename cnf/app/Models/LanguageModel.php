<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'name', 'is_active'];
    protected $useTimestamps = true;
    
    public function getActiveLanguages()
    {
        return $this->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
    }
    
    public function getLanguageByCode($code)
    {
        return $this->where('code', $code)->first();
    }
    
    public function getLanguageIdByCode($code)
    {
        $language = $this->where('code', $code)->first();
        return $language ? $language['id'] : null;
    }
}