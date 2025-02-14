<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\RewardGolonganModel;
use App\Models\TrafficModel;
use App\Models\HeroModel;
use App\Models\SetoranModel;

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

        $heroModel = new HeroModel();
        $aboutusData = $heroModel->find(1)['hero_isi'];
        preg_match('/<p>(.*?)<\/p>/', $aboutusData, $matches);
        $aboutus = isset($matches[0]) ? $matches[0] : '';

        $beritaModel = new BeritaModel();
        $beritaData = $beritaModel->orderBy('created_at', 'DESC')->findAll(2);
        $beritaFormatted = [];
        foreach ($beritaData as $berita) {
            $beritaFormatted[] = [
                'berita_judul'  => $this->limitWords($berita['berita_judul'], 5),
                'berita_isi'    => $this->limitWords(strip_tags($berita['berita_isi']), 10),
                'berita_slug'   => $berita['berita_slug'],
                'berita_gambar' => $berita['berita_gambar']
            ];
        }
        
        $setoranModel = new SetoranModel();
        $setoranJumlahData = $setoranModel->selectSum('setoran_jumlah')->first();
        
        $setoran['setoran_total'] = number_format($setoranJumlahData['setoran_jumlah'], 2, ',', '.');
        $setoran['setoran_metana'] = number_format(0.127 * $setoranJumlahData['setoran_jumlah'], 2, ',', '.');        
        
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_guest') .
            view('guest/index', [
                'berita' => $beritaFormatted,
                'aboutus' => $aboutus,
                'groupedRewards' => $groupedRewards,
                'setoran' => $setoran
            ]) .
            view('templates/footbar_guest') .
            view('templates/footer');
    }

    public function aboutus()
    {
        $status = [
            'page' => 'about-us',
            'judul' => 'About Us'
        ]; 

        $heroModel = new HeroModel();
        $heroData = $heroModel->find(1);
        $aboutus = $heroData['hero_isi'];

        return 
        view('templates/header', $status) .
        view('templates/navbar_guest') .
        view('guest/about-us', [
            'aboutus' => $aboutus
        ]) .
        view('templates/footbar_guest') .
        view('templates/footer');
    }

    public function latarbelakang()
    {
        $status = [
            'page' => 'latar-belakang',
            'judul' => 'Latar Belakang'
        ]; 

        return 
        view('templates/header', $status) .
        view('templates/navbar_guest') .
        view('guest/latar-belakang') .
        view('templates/footbar_guest') .
        view('templates/footer');
    }

    protected function limitWords($text, $limit)
    {
        $words = explode(' ', trim($text));
        return count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . '...' : $text;
    }
}