<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta';
    
    protected $primaryKey = 'peserta_id';
    protected $allowedFields = ['peserta_nama', 'peserta_kontak', 'peserta_kartu'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPesertaByIdWithSetoran($id)
    {
        $builder = $this->builder();

        $builder->select('peserta.peserta_id, peserta.peserta_kartu, peserta.peserta_nama, peserta.peserta_kontak, peserta.created_at, peserta.updated_at');
        $builder->select('SUM(CASE WHEN MONTH(setoran.created_at) = MONTH(CURRENT_DATE()) THEN setoran.setoran_jumlah ELSE 0 END) as setoran_bulan');
        $builder->select('SUM(setoran.setoran_jumlah) as setoran_total');
        $builder->join('setoran', 'setoran.peserta_id = peserta.peserta_id', 'left');
        $builder->where('peserta.peserta_id', $id);
        
        $result = $builder->get()->getRowArray();

        return $result;
    }
}


