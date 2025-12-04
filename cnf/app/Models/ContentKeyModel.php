<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentKeyModel extends Model
{
    protected $table = 'content_keys';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key_name', 'description', 'category'];
    protected $useTimestamps = true;
}