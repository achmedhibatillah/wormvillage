<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\SetoranModel;
use App\Models\TrafficModel;
use App\Models\RewardGolonganModel;

class User extends BaseController
{
    public function __construct()
    {
        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 21
        ]);
    }
    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }

    public function index(): string
    {
        $status = [
            'page' => 'user',
            'judul' => 'Dashboard'
        ];
        
        $pesertaId = session('peserta_id'); 
        $pesertaModel = new PesertaModel();
        $pesertaData = $pesertaModel->find($pesertaId); 
        $peserta  = $pesertaData;

        $reward = new RewardGolonganModel();
        $rewardall = $reward->getAllReward();
        $groupedRewards = [];
        foreach ($rewardall as $reward) {
            $groupedRewards[$reward['reward_golongan_id']][$reward['reward_golongan_berat']][] = $reward;
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_user', [
                'peserta' => $peserta
            ]) .
            view('user/index', [
                'peserta' => $peserta,
                'groupedRewards' => $groupedRewards
            ]) .
            view('templates/footbar_user') .
            view('templates/footer');
    }
    
    public function profil(): string
    {
        $status = [
            'page' => 'user',
            'judul' => 'Profil'
        ];
        
        $pesertaId = session('peserta_id'); 
        $pesertaModel = new PesertaModel();
        $setoranModel = new setoranModel();
        $rewardGolonganModel = new RewardGolonganModel();

        $peserta = $pesertaModel->getPesertaByIdWithSetoran($pesertaId);
        $setoran = $setoranModel->getSetoranByIdPeserta($pesertaId);
        $rewardgolongan = $rewardGolonganModel->orderBy('reward_golongan_berat', 'DESC')->findAll();

        $statusreward = 0;
        foreach($rewardgolongan as $r) {
            if ($peserta['setoran_total'] > $r['reward_golongan_berat']) {
                $statusreward = $r['reward_golongan_berat'];
                break;
            }
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_user', [
                'peserta' => $peserta
            ]) .
            view('user/profil', [
                'peserta' => $peserta,
                'statusreward' => $statusreward,
                'setoran' => $setoran
            ]) .
            view('templates/footbar_user') .
            view('templates/footer');
    }

}