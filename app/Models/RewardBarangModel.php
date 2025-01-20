<?php

namespace App\Models;

use CodeIgniter\Model;

class RewardBarangModel extends Model
{
    protected $table      = 'reward_barang';
    protected $primaryKey = 'reward_barang_id';

    protected $allowedFields = [
        'reward_barang_barang',
        'reward_golongan_id',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllReward()
    {
        return $this->select('reward_barang.*, reward_golongan.reward_golongan_berat')
                    ->join('reward_golongan', 'reward_golongan.reward_golongan_id = reward_barang.reward_golongan_id')
                    ->findAll();
    }

    public function getRewardById($reward_golongan_id)
    {
        return $this->select('reward_barang.*, reward_golongan.reward_golongan_berat')
                    ->join('reward_golongan', 'reward_golongan.reward_golongan_id = reward_barang.reward_golongan_id')
                    ->where('reward_golongan.reward_golongan_id', $reward_golongan_id)
                    ->findAll();
    } 
}
