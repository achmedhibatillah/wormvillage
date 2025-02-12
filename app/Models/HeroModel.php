<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroModel extends Model
{
    protected $table = 'hero';
    protected $primaryKey = 'hero_id';
    protected $allowedFields = [
        'hero_id',
        'hero_isi',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
