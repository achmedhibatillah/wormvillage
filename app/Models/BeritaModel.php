<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'berita_id';
    protected $allowedFields = [
        'berita_judul',
        'berita_isi',
        'berita_gambar',
        'admin_id',
        'created_at',
        'updated_at'
    ]; 

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
