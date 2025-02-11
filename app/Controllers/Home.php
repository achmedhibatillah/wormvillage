<?php

namespace App\Controllers;

use App\Models\RewardGolonganModel;
use App\Models\TrafficModel;

class Home extends BaseController
{
    public function __construct()
    {
        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 1
        ]);
    }

    public function index(): string
    {
        $status = [
            'page' => 'home',
            'judul' => 'Home'
        ]; 

        $reward = new RewardGolonganModel();
        $rewardall = $reward->getAllReward();
        $groupedRewards = [];
        foreach ($rewardall as $reward) {
            $groupedRewards[$reward['reward_golongan_id']][$reward['reward_golongan_berat']][] = $reward;
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_guest') .
            view('guest/index', [
                'groupedRewards' => $groupedRewards
            ]) .
            view('templates/footbar_guest') .
            view('templates/footer');
    }

}