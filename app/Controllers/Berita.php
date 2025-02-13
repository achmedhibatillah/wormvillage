<?php

namespace App\Controllers;

use App\Models\RewardGolonganModel;
use App\Models\TrafficModel;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    public function __construct()
    {
        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 1
        ]);
    }

    public function berita(): string
    {
        $beritaModel = new BeritaModel();
        
        $k = $this->request->getGet('k');
        if (!empty($k)) {
            $beritaData = $beritaModel->orderBy('created_at', 'DESC')->like('berita_judul', $k)->orLike('berita_isi', $k)->findAll();
        } else {
            $beritaData = $beritaModel->orderBy('created_at', 'DESC')->findAll();
        }
    
        $status = [
            'page' => 'berita',
            'judul' => 'Berita'
        ]; 
    
        $beritaFormatted = [];
        foreach ($beritaData as $berita) {
            $beritaFormatted[] = [
                'berita_judul'  => $this->limitWords($berita['berita_judul'], 5),
                'berita_isi'    => $this->limitWords(strip_tags($berita['berita_isi']), 10),
                'berita_slug'   => $berita['berita_slug'],
                'berita_gambar' => $berita['berita_gambar']
            ];
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_guest') .
            view('guest/berita', [
                'berita' => $beritaFormatted,
                'k'=> $k
            ]) .
            view('templates/footbar_guest') .
            view('templates/footer');
    }
    

    public function detail($berita_slug): string
    {
        $beritaModel = new BeritaModel();
        $beritaData = $beritaModel->where('berita_slug', $berita_slug)->first();
    
        $status = [
            'page' => 'berita',
            'judul' => 'Berita - ' . $beritaData['berita_judul']
        ]; 
    
        $beritacardData = $beritaModel->orderBy('created_at', 'DESC')->findAll(3);
        $beritacardData = array_filter($beritacardData, function ($berita) use ($berita_slug) {
            return $berita['berita_slug'] !== $berita_slug;
        });
        $beritacardData = array_slice($beritacardData, 0, 3);
        $beritaFormatted = [];
        foreach ($beritacardData as $berita) {
            $beritaFormatted[] = [
                'berita_judul'  => $this->limitWords($berita['berita_judul'], 5),
                'berita_isi'    => $this->limitWords(strip_tags($berita['berita_isi']), 10),
                'berita_slug'   => $berita['berita_slug'],
                'berita_gambar' => $berita['berita_gambar']
            ];
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_guest') .
            view('guest/berita-detail', [
                'berita' => $beritaData,
                'beritacard' => $beritaFormatted
            ]) .
            view('templates/footbar_guest') .
            view('templates/footer');
    }
    

    public function index(): string
    {
        $status = [
            'page' => 'berita',
            'judul' => 'Atur Berita'
        ]; 
        
        $beritaModel = new BeritaModel();
        
        $k = $this->request->getGet('k');
    
        if (!empty($k)) {
            $berita = $beritaModel->orderBy('created_at', 'DESC')->like('berita_judul', $k)->findAll();
        } else {
            $berita = $beritaModel->orderBy('created_at', 'DESC')->findAll();
        }
    
        return 
            view('templates/header', $status) .
            view('templates/navbar_admin') .
            view('admin/berita', [
                'berita' => $berita,
                'k' => $k
            ]) .
            view('templates/footbar_admin') .
            view('templates/footer');
    }    

    public function tambah(): string
    {
        $status = [
            'page' => 'berita',
            'judul' => 'Tambah Berita'
        ]; 
        
        return 
            view('templates/header', $status) .
            view('templates/navbar_admin') .
            view('admin/berita-tambah') .
            view('templates/footbar_admin') .
            view('templates/footer');
    }

    public function lihat($berita_slug): string
    {
        $status = [
            'page' => 'berita',
            'judul' => 'Lihat Detail Berita'
        ]; 

        $beritaModel = new BeritaModel();
        $beritaData = $beritaModel->where('berita_slug', $berita_slug)->first();
        
        return 
            view('templates/header', $status) .
            view('templates/navbar_admin') .
            view('admin/berita-detail', [
                'berita' => $beritaData
            ]) .
            view('templates/footbar_admin') .
            view('templates/footer');
    }

    public function simpan()
    {
        $validation =  \Config\Services::validation();
        
        $validation->setRules([
            'berita_judul' => 'required|max_length[255]',
            'berita_isi' => 'required'
        ], [
            'berita_judul' => [
                'required' => 'Judul harus diisi.',
                'max_length' => 'Maksimal panjang judul adalah 255 karakter.'
            ],
            'berita_isi' => [
                'required' => 'Isi berita tidak boleh kosong.'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-berita', $validation->getErrors());
        }

        $file = $this->request->getFile('berita_gambar');
        $filePath = null;
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imagePath = $file->getTempName();
            $mimeType = $file->getMimeType();
        
            if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                if ($mimeType === 'image/png') {
                    $image = @imagecreatefrompng($imagePath);
                } else {
                    $image = @imagecreatefromjpeg($imagePath);
                }
        
                if ($image) {
                    $quality = 90;
                    do {
                        ob_start();
                        if ($mimeType === 'image/png') {
                            imagepng($image, null, (int)($quality / 10));
                        } else {
                            imagejpeg($image, null, $quality);
                        }
                        $compressedImage = ob_get_clean();
                        $fileSize = strlen($compressedImage);
                        $quality -= 5;
                    } while ($fileSize > 400 * 1024 && $quality > 10);
        
                    $fileName = uniqid('dok_', true) . '.jpg';
                    $filePath = 'images/berita/' . $fileName;
                
                    $savePath = FCPATH . 'images/berita/' . $fileName;
        
                    if ($mimeType === 'image/png') {
                        imagepng($image, $savePath, (int)($quality / 10));
                    } else {
                        imagejpeg($image, $savePath, $quality);
                    }
        
                    imagedestroy($image);
                } else {
                    return redirect()->back()->with('error', 'File gambar tidak valid atau rusak.');
                }
            } else {
                return redirect()->back()->with('error', 'Format file harus JPG atau PNG.');
            }
        }
        
        $admin_username = session()->get('admin_username');

        $beritaModel = new BeritaModel();

        $judul = $this->request->getPost('berita_judul');
        $slug = url_title($judul, '-', true);
        $slugAsli = $slug;
        $i = 1;
        while ($beritaModel->where('berita_slug', $slug)->first()) {
            $slug = $slugAsli . '-' . $i;
            $i++;
        }

        $save = [
            'berita_judul' => $this->request->getPost('berita_judul'),
            'berita_gambar' => $filePath,
            'berita_isi' => $this->request->getPost('berita_isi'),
            'berita_slug' => $slug,
            'admin_username' => $admin_username
        ];

        $beritaModel->insert($save);

        return redirect()->to('atur-berita')->with('success-berita', 'Berita baru berhasil ditambahkan.');
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $beritaModel = new BeritaModel();
        
        $validation->setRules([
            'berita_judul' => 'required|max_length[255]',
            'berita_isi' => 'required'
        ], [
            'berita_judul' => [
                'required' => 'Judul harus diisi.',
                'max_length' => 'Maksimal panjang judul adalah 255 karakter.'
            ],
            'berita_isi' => [
                'required' => 'Isi berita tidak boleh kosong.'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-berita', $validation->getErrors());
        }

        if (!empty($berita['berita_gambar'])) {
            $filePath = FCPATH . $beritaModel['berita_gambar'];
    
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $file = $this->request->getFile('berita_gambar');
        $filePath = null;
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imagePath = $file->getTempName();
            $mimeType = $file->getMimeType();
        
            if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                if ($mimeType === 'image/png') {
                    $image = @imagecreatefrompng($imagePath);
                } else {
                    $image = @imagecreatefromjpeg($imagePath);
                }
        
                if ($image) {
                    $quality = 90;
                    do {
                        ob_start();
                        if ($mimeType === 'image/png') {
                            imagepng($image, null, (int)($quality / 10));
                        } else {
                            imagejpeg($image, null, $quality);
                        }
                        $compressedImage = ob_get_clean();
                        $fileSize = strlen($compressedImage);
                        $quality -= 5;
                    } while ($fileSize > 400 * 1024 && $quality > 10);
        
                    $fileName = uniqid('dok_', true) . '.jpg';
                    $filePath = 'images/berita/' . $fileName;
                
                    $savePath = FCPATH . 'images/berita/' . $fileName;
        
                    if ($mimeType === 'image/png') {
                        imagepng($image, $savePath, (int)($quality / 10));
                    } else {
                        imagejpeg($image, $savePath, $quality);
                    }
        
                    imagedestroy($image);
                } else {
                    return redirect()->back()->with('error', 'File gambar tidak valid atau rusak.');
                }
            } else {
                return redirect()->back()->with('error', 'Format file harus JPG atau PNG.');
            }
        }
        
        $admin_username = session()->get('admin_username');

        $judul = $this->request->getPost('berita_judul');
        $slug = url_title($judul, '-', true);
        $slugAsli = $slug;
        $i = 1;
        while ($beritaModel->where('berita_slug', $slug)->first()) {
            $slug = $slugAsli . '-' . $i;
            $i++;
        }

        $update = [
            'berita_judul' => $this->request->getPost('berita_judul'),
            'berita_gambar' => $filePath,
            'berita_isi' => $this->request->getPost('berita_isi'),
            'berita_slug' => $slug,
            'admin_username' => $admin_username
        ];

        $berita_id = $this->request->getPost('berita_id');
        $beritaModel->update($berita_id, $update);

        return redirect()->to('atur-berita')->with('success-berita', 'Berita baru berhasil ditambahkan.');       
    }

    public function hapus($berita_id)
    {
        $beritaModel = new BeritaModel();
        $berita = $beritaModel->find($berita_id);
    
        if (!empty($berita['berita_gambar'])) {
            $filePath = FCPATH . $berita['berita_gambar'];
    
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    
        $beritaModel->delete($berita_id);
    
        return redirect()->to('atur-berita')->with('success-berita', 'Berita berhasil dihapus.');
    }
    
    protected function limitWords($text, $limit)
    {
        $words = explode(' ', trim($text));
        return count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . '...' : $text;
    }
}