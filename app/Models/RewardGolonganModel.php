<?php

namespace App\Models;

use CodeIgniter\Model;

class RewardGolonganModel extends Model
{
    protected $table      = 'reward_golongan';
    protected $primaryKey = 'reward_golongan_id';

    protected $allowedFields = [
        'reward_golongan_id',
        'reward_golongan_berat',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllReward()
    {
        return $this->select('reward_golongan.*, reward_barang.reward_barang_id, reward_barang.reward_barang_barang, reward_barang.created_at AS barang_created_at')
                    ->join('reward_barang', 'reward_barang.reward_golongan_id = reward_golongan.reward_golongan_id', 'left')
                    ->orderBy('reward_golongan.reward_golongan_berat', 'ASC')
                    ->findAll();
    }  
    
    public function getRewardById($reward_golongan_id)
    {
        return $this->select('reward_barang.*, reward_golongan.reward_golongan_berat')
                    ->join('reward_barang', 'reward_barang.reward_golongan_id = reward_golongan.reward_golongan_id')
                    ->where('reward_golongan.reward_golongan_id', $reward_golongan_id)
                    ->findAll();
    }
}
