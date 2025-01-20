<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoranModel extends Model
{
    protected $table = 'setoran';
    protected $primaryKey = 'setoran_id';
    protected $allowedFields = ['setoran_jumlah', 'setoran_keterangan', 'setoran_dokumentasi', 'peserta_id'];
    protected $useTimestamps = true;

    public function dashboard_sampahterkumpul()
    {
        $today = date('Y-m-d');

        return $this->selectSum('setoran_jumlah')
                    ->where('DATE(created_at)', $today)
                    ->first();
    }

    public function dashboard_stempelterbagi()
    {
        $today = date('Y-m-d');
    
        return $this->where('DATE(created_at)', $today)
                    ->countAllResults();
    }    

    public function dashboard_pesertaaktif()
    {
        $today = date('Y-m-d');

        return $this->select('peserta_id')
                    ->where('DATE(created_at)', $today)
                    ->distinct()
                    ->countAllResults();
    }

    public function getSetoranWithPesertaByDateRange($startDate, $endDate)
    {
        return $this->select('setoran.*, peserta.peserta_nama')
                    ->join('peserta', 'peserta.peserta_id = setoran.peserta_id')
                    ->where('setoran.created_at >=', $startDate . ' 00:00:00')
                    ->where('setoran.created_at <=', $endDate . ' 23:59:59')
                    ->orderBy('setoran.created_at', 'DESC')
                    ->findAll();
    }

    public function getSetoranById($id)
    {
        return $this->select('setoran.setoran_id, setoran.setoran_jumlah, setoran.setoran_keterangan, setoran.setoran_dokumentasi, setoran.created_at, peserta.peserta_nama')
                    ->join('peserta', 'peserta.peserta_id = setoran.peserta_id')
                    ->where('setoran.setoran_id', $id)
                    ->first();
    }

    public function getSetoranByIdPeserta($id)
    {
        $builder = $this->builder();

        $builder->select('setoran.setoran_id, setoran.setoran_jumlah, setoran.created_at');
        $builder->where('setoran.peserta_id', $id);
        $builder->orderBy('setoran.created_at', 'DESC');
        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getCountSetoranByIdPeserta($id)
    {
        $builder = $this->builder();

        // Menggunakan SUM untuk menjumlahkan setoran_jumlah
        $builder->selectSum('setoran.setoran_jumlah', 'total_setoran');
        $builder->where('setoran.peserta_id', $id);
        $result = $builder->get()->getRowArray(); // Mengambil hasil sebagai array

        return $result['total_setoran'] ?? 0; // Jika tidak ada setoran, return 0
    }

    
    public function analitik_setoranmingguan()
    {
        $sevenDaysAgo = date('Y-m-d 00:00:00', strtotime('-6 days'));
        $today = date('Y-m-d 23:59:59');

        return $this->select('DATE(created_at) as tanggal, SUM(setoran_jumlah) as total_setoran')
                    ->where('created_at >=', $sevenDaysAgo)
                    ->where('created_at <=', $today)
                    ->groupBy('DATE(created_at)')
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }

    public function analitik_setoranbulanan()
    {
        $thirtyDaysAgo = date('Y-m-d 00:00:00', strtotime('-29 days'));
        $today = date('Y-m-d 23:59:59');

        return $this->select('DATE(created_at) as tanggal, SUM(setoran_jumlah) as total_setoran')
                    ->where('created_at >=', $thirtyDaysAgo)
                    ->where('created_at <=', $today)
                    ->groupBy('DATE(created_at)')
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }

    public function analitik_setoranbulananfix($bulan = null, $tahun = null)
    {
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');
    
        $startDate = $tahun . '-' . $bulan . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));
    
        return $this->select('DATE(created_at) as tanggal, SUM(setoran_jumlah) as total_setoran')
                    ->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->groupBy('DATE(created_at)')
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }    

    public function analitik_setoranall()
    {
        return $this->select('DATE(created_at) as tanggal, SUM(setoran_jumlah) as total_setoran')
                    ->groupBy('DATE(created_at)')
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }
    
}
