<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\SetoranModel;
use App\Models\AdminModel;
use App\Models\TrafficModel;
use App\Models\RewardGolonganModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Admin extends BaseController
{
    public function __construct()
    {
        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 22
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
            'page' => 'dashboard',
            'judul' => 'Dashboard'
        ];
        
        $SetoranModel = new SetoranModel();
        $sampahterkumpul = $SetoranModel->dashboard_sampahterkumpul();
        $stempelterbagi = $SetoranModel->dashboard_stempelterbagi();
        $pesertaaktif = $SetoranModel->dashboard_pesertaaktif();
        $setoranall = $SetoranModel->analitik_setoranall();

        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/index', [
            'sampahterkumpul' => $sampahterkumpul,
            'stempelterbagi' => $stempelterbagi,
            'pesertaaktif' => $pesertaaktif,
            'setoranall' => $setoranall
            ]) .
        view('templates/footer');
    }

    public function setoran(): string
    {
        $setoranModel = new SetoranModel();
    
        $dateRange = $this->request->getGet('date_range');
        $startDate = '';
        $endDate = '';
    
        if ($dateRange) {
            $dates = explode(' to ', $dateRange);
            $startDate = $dates[0];
            $endDate = $dates[1] ?? $startDate;
        } else {
            $startDate = $endDate = date('Y-m-d');
        }
    
        $setoranData = $setoranModel->getSetoranWithPesertaByDateRange($startDate, $endDate);
    
        $status = [
            'page' => 'setoran',
            'judul' => 'Riwayat Setoran'
        ];
    
        foreach ($setoranData as &$setoran) {
            $setoran['created_at'] = date('d M Y | H:i', strtotime($setoran['created_at']));
        }
    
        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/setoran', ['setoranData' => $setoranData]) .
        view('templates/footer');
    }
    
    public function catat_setoran(): string
    {
        $status = [
            'page' => 'catat-setoran',
            'judul' => 'Catat Setoran'
        ];
        
        $searchQuery = $this->request->getVar('search');
        $model = new PesertaModel();
        
        if ($searchQuery) {
            $dataPeserta = $model->like('peserta_nama', $searchQuery)
                                 ->orLike('peserta_kartu', $searchQuery)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();
        } else {
            $dataPeserta = $model->orderBy('created_at', 'DESC')->findAll();
        }
        
        foreach ($dataPeserta as &$peserta) {
            $peserta['created_at'] = date('d/m/Y | H:i', strtotime($peserta['created_at']));
        }
    
        return 
        view('templates/header', $status) . 
        view('templates/navbar_admin', $status) . 
        view('admin/setoran-catat', ['peserta' => $dataPeserta]) . 
        view('templates/footer');
    }

    public function tambah_setoran($id): string
    {
        $model = new PesertaModel();
        $peserta = $model->where('peserta_id', $id)->first();

        $status = [
            'page' => 'tambah-setoran',
            'judul' => 'Tambah Setoran'
        ];

        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/setoran-tambah', [
            'id' => $id,
            'peserta_nama' => $peserta['peserta_nama'],
            'peserta_kartu' => $peserta['peserta_kartu']
            ]) .
        view('templates/footer');
    }

    public function peserta_ss()
    {
        $searchQuery = $this->request->getVar('search');

        $model = new PesertaModel();
        if ($searchQuery) {
            $dataPeserta = $model->like('peserta_nama', $searchQuery)
                                ->orLike('peserta_kartu', $searchQuery)
                                ->orderBy('created_at', 'DESC')
                                ->findAll();
        } else {
            $dataPeserta = $model->orderBy('created_at', 'DESC')->findAll();
        }

        foreach ($dataPeserta as &$peserta) {
            $peserta['created_at'] = date('d/m/Y | H:i', strtotime($peserta['created_at']));
        }

        $output = '';
        foreach ($dataPeserta as $index => $p) {
            $output .= '<tr>';
            $output .= '<td>' . ($index + 1) . '</td>';
            $output .= '<td>' . esc($p['peserta_kartu']) . '</td>';
            $output .= '<td>' . esc($p['peserta_nama']) . '</td>';
            $output .= '<td class="align-items-end">';
            $output .= '<a href="' . base_url('tambah-setoran/' . esc($p['peserta_id'])) . '" class="btn btn-primary btn-sm text-light"><i class="fas fa-add"></i></a>';
            $output .= '</td>';
            $output .= '</tr>';
        }

        return $output;
    }

    public function setoran_a() 
    {
        $validation =  \Config\Services::validation();
        
        $validation->setRules([
            'setoran-utama' => 'required_without[setoran-desimal]|numeric',
            'setoran-desimal' => 'required_without[setoran-utama]|numeric|max_length[2]',
            'setoran-dokumentasi' => 'uploaded[setoran-dokumentasi]|is_image[setoran-dokumentasi]|mime_in[setoran-dokumentasi,image/jpeg,image/png]',
        ], [
            'setoran-utama' => [
                'required_without' => 'Isi angka sebelum koma.',
                'numeric' => 'Jumlah setoran utama harus berupa angka.'
            ],
            'setoran-desimal' => [
                'required_without' => 'Isi angka setelah koma.',
                'numeric' => 'Jumlah setoran desimal harus berupa angka.',
                'max_length' => 'Jumlah desimal maksimal terdiri dari 2 angka.'
            ],
            'setoran-dokumentasi' => [
                'uploaded' => 'Dokumentasi gambar harus diunggah.',
                'is_image' => 'File yang diunggah harus berupa gambar.',
                'mime_in' => 'Dokumentasi gambar hanya boleh dalam format JPG, JPEG, atau PNG.'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $setoranJumlah = $this->request->getPost('setoran-utama') . '.' . $this->request->getPost('setoran-desimal');
        $setoranKeterangan = $this->request->getPost('setoran-keterangan');
        
        $fileDokumentasi = $this->request->getFile('setoran-dokumentasi');
        $fileDokumentasiPath = null;
        
        if ($fileDokumentasi && $fileDokumentasi->isValid() && !$fileDokumentasi->hasMoved()) {
            $imagePath = $fileDokumentasi->getTempName();
            $mimeType = $fileDokumentasi->getMimeType();
        
            if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg'])) {
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
        
                    $fileName = uniqid('dok_', true) . '.' . pathinfo($fileDokumentasi->getClientName(), PATHINFO_EXTENSION);
                    $fileDokumentasiPath = 'images/dokumentasi/' . $fileName;
                
                    $savePath = FCPATH . 'images/dokumentasi/' . $fileName;
                    file_put_contents($savePath, $compressedImage);                    
    
                    imagedestroy($image);
                } else {
                    return redirect()->back()->with('error', 'File gambar tidak valid atau rusak.');
                }
            } else {
                return redirect()->back()->with('error', 'Format file harus JPG, JPEG, atau PNG.');
            }
        } 
    
        $setoranModel = new SetoranModel();
        $setoranModel->insert([
            'setoran_jumlah'      => $setoranJumlah,
            'setoran_keterangan'  => $setoranKeterangan,
            'setoran_dokumentasi' => $fileDokumentasiPath,
            'peserta_id'          => $this->request->getPost('peserta-id')
        ]);
        
        $newSetoranId = $setoranModel->insertID();
    
        return redirect()->to("/setoran/{$newSetoranId}")->with('success', 'Setoran baru berhasil ditambahkan.');
    }
    
    public function setoran_d($id)
    {
        $setoranModel = new SetoranModel();
        $setoran = $setoranModel->find($id);
    
        if ($setoran) {
            $dokumentasiPath = FCPATH . $setoran['setoran_dokumentasi'];
    
            if ($setoran['setoran_dokumentasi'] && file_exists($dokumentasiPath)) {
                unlink($dokumentasiPath);
            }
    
            $setoranModel->delete($id);
    
            $searchQuery = $this->request->getGet('search');
    
            return redirect()->to('/setoran?' . $searchQuery)
                ->with('success', 'Setoran dengan ID #' . $id . ' berhasil dihapus.');
        } else {
            return redirect()->to('/setoran')
                ->with('error', 'Setoran tidak ditemukan.');
        }
    }    

    public function setoran_d_halaman_peserta($setoran_id, $peserta_id)
    {
        $setoranModel = new SetoranModel();
        $setoran = $setoranModel->find($setoran_id);
    
        if ($setoran) {
            $dokumentasiPath = FCPATH . $setoran['setoran_dokumentasi'];
    
            if ($setoran['setoran_dokumentasi'] && file_exists($dokumentasiPath)) {
                unlink($dokumentasiPath);
            }
    
            $setoranModel->delete($setoran_id);
    
    
            return redirect()->to('/peserta/' . $peserta_id)
                ->with('success', 'Setoran dengan ID #' . $setoran_id . ' berhasil dihapus.');
        } else {
            return redirect()->to('/peserta/' . $peserta_id)
                ->with('error', 'Setoran tidak ditemukan.');
        }
    }    
    
    public function setoran_detail($id): string
    {
        $setoranModel = new SetoranModel();
        $setoran = $setoranModel->getSetoranById($id);
    
        $status = [
            'page' => 'setoran',
            'judul' => 'Detail Setoran'
        ];
    
        return 
            view('templates/header', $status) . 
            view('templates/navbar_admin', $status) . 
            view('admin/setoran-detail', ['setoran' => $setoran]) . 
            view('templates/footer');
    }
    
    public function peserta(): string
    {
        $status = [
            'page' => 'peserta',
            'judul' => 'Daftar Peserta'
        ];
        
        $searchQuery = $this->request->getVar('search');
        $model = new PesertaModel();
        
        if ($searchQuery) {
            $dataPeserta = $model->like('peserta_nama', $searchQuery)
                                 ->orLike('peserta_kartu', $searchQuery)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();
        } else {
            $dataPeserta = $model->orderBy('created_at', 'DESC')->findAll();
        }
        
        $setoranModel = new SetoranModel();
        foreach ($dataPeserta as &$peserta) {
            $peserta['created_at'] = date('d M Y | H:i', strtotime($peserta['created_at']));
            $totalSetoran = $setoranModel->getCountSetoranByIdPeserta($peserta['peserta_id']);
            $peserta['total_setoran'] = $totalSetoran;
        }
    
        return 
        view('templates/header', $status) . 
        view('templates/navbar_admin', $status) . 
        view('admin/peserta', [
            'peserta' => $dataPeserta
            ]) . 
        view('templates/footer');
    }

    public function peserta_detail($id): string
    {
        $pesertaModel = new pesertaModel();
        $setoranModel = new setoranModel();
        $rewardGolonganModel = new RewardGolonganModel();

        $peserta = $pesertaModel->getPesertaByIdWithSetoran($id);
        $setoran = $setoranModel->getSetoranByIdPeserta($id);
        $rewardgolongan = $rewardGolonganModel->findAll();
    
        $status = [
            'page' => 'peserta',
            'judul' => 'Detail Peserta'
        ];
    
        return 
            view('templates/header', $status) . 
            view('templates/navbar_admin', $status) . 
            view('admin/peserta-detail', [
                'peserta' => $peserta,
                'setoran' => $setoran,
                'rewardgolongan' => $rewardgolongan
                ]) . 
            view('templates/footer');
    }
    
    public function peserta_s()
    {
        $searchQuery = $this->request->getVar('search');

        $model = new PesertaModel();
        if ($searchQuery) {
            $dataPeserta = $model->like('peserta_nama', $searchQuery)
                                ->orLike('peserta_kartu', $searchQuery)
                                ->orderBy('created_at', 'DESC')
                                ->findAll();
        } else {
            $dataPeserta = $model->orderBy('created_at', 'DESC')->findAll();
        }

        foreach ($dataPeserta as &$peserta) {
            $peserta['created_at'] = date('d/m/Y | H:i', strtotime($peserta['created_at']));
        }

        $output = '';
        foreach ($dataPeserta as $index => $p) {
            $output .= '<tr>';
            $output .= '<td>' . ($index + 1) . '</td>';
            $output .= '<td>' . esc($p['peserta_kartu']) . '</td>';
            $output .= '<td>' . esc($p['peserta_nama']) . '</td>';
            $output .= '<td>' . esc($p['peserta_kontak']) . '</td>';
            $output .= '<td>' . esc($p['created_at']) . '</td>';
            $output .= '<td class="align-items-end">';
            $output .= '<a href="' . base_url('peserta/' . esc($p['peserta_id'])) . '" class="btn btn-success btn-sm text-light"><i class="fas fa-eye"></i></a>';
            $output .= '<a href="' . base_url('edit-peserta/' . esc($p['peserta_id'])) . '" class="btn btn-warning btn-sm text-light"><i class="fas fa-pencil"></i></a>';
            $output .= '<a href="javascript:void(0);" onclick="peserta_delete(' . $p['peserta_id'] . ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
            $output .= '</td>';
            $output .= '</tr>';
        }

        return $output;
    }

    public function tambah_peserta(): string
    {
        $status = [
            'page' => 'tambah-peserta',
            'judul' => 'Tambah Peserta'
        ];

        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/peserta-tambah') .
        view('templates/footer');
    }

    public function edit_peserta($id)
    {
        $model = new PesertaModel();
        $peserta = $model->find($id);
    
        if (!$peserta) {
            session()->setFlashdata('error', 'Peserta tidak ditemukan.');
            return redirect()->to('/peserta');
        }
    
        $data = [
            'peserta' => $peserta,
            'judul' => 'Edit Peserta'
        ];
    
        return
        view('templates/header', ['page' => 'peserta', 'judul' => 'Edit Peserta']) . 
        view('templates/navbar_admin', ['page' => 'peserta', 'judul' => 'Edit Peserta']) .
        view('admin/peserta-edit', $data) . 
        view('templates/footer');
    }

    public function peserta_a()
    {
        $model = new PesertaModel();

        $rules = [
            'peserta-nama' => 'required|min_length[3]|max_length[255]',
            'peserta-kontak' => 'required|numeric|min_length[10]|max_length[15]',
            'peserta-kartu' => 'required|numeric'
        ];

        $errors = [
            'peserta-nama' => [
                'required' => 'Nama lengkap harus diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
                'max_length' => 'Nama lengkap maksimal 255 karakter.'
            ],
            'peserta-kontak' => [
                'required' => 'Nomor kontak harus diisi.',
                'numeric' => 'Nomor kontak harus berupa angka.',
                'min_length' => 'Nomor kontak minimal 11 digit.',
                'max_length' => 'Nomor kontak maksimal 15 digit.'
            ],
            'peserta-kartu' => [
                'required' => 'Nomor kartu kendali harus diisi.',
                'numeric' => 'Nomor kartu kendali harus berupa angka.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/tambah-peserta')->withInput();
        }

        $peserta_nama = $this->request->getPost('peserta-nama');
        $peserta_kontak = $this->request->getPost('peserta-kontak');
        $peserta_kartu = $this->request->getPost('peserta-kartu');

        $peserta_nama = ucwords(strtolower($peserta_nama));


        if (substr($peserta_kontak, 0, 1) === '0') {
            $peserta_kontak = '62' . substr($peserta_kontak, 1);
        }

        $data = [
            'peserta_nama' => $peserta_nama,
            'peserta_kontak' => $peserta_kontak,
            'peserta_kartu' => $peserta_kartu
        ];

        if ($model->save($data)) {
            session()->setFlashdata('success', 'Data peserta atas nama ' . $data['peserta_nama'] . ' berhasil disimpan.');
        } else {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }

        $newPesertaId = $model->insertID();
        return redirect()->to("/peserta/{$newPesertaId}");
    }

    public function peserta_e($id)
    {
        $model = new PesertaModel();

        $rules = [
            'peserta-nama' => 'required|min_length[3]|max_length[255]',
            'peserta-kontak' => 'required|numeric|min_length[10]|max_length[15]',
            'peserta-kartu' => 'required|numeric'
        ];

        $errors = [
            'peserta-nama' => [
                'required' => 'Nama lengkap harus diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
                'max_length' => 'Nama lengkap maksimal 255 karakter.'
            ],
            'peserta-kontak' => [
                'required' => 'Nomor kontak harus diisi.',
                'numeric' => 'Nomor kontak harus berupa angka.',
                'min_length' => 'Nomor kontak minimal 10 digit.',
                'max_length' => 'Nomor kontak maksimal 15 digit.'
            ],
            'peserta-kartu' => [
                'required' => 'Nomor kartu kendali harus diisi.',
                'numeric' => 'Nomor kartu kendali harus berupa angka.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/edit-peserta/' . $id)->withInput();
        }

        $data = [
            'peserta_nama' => $this->request->getPost('peserta-nama'),
            'peserta_kontak' => $this->request->getPost('peserta-kontak'),
            'peserta_kartu' => $this->request->getPost('peserta-kartu'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($model->update($id, $data)) {
            session()->setFlashdata('success', 'Data peserta berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data peserta.');
        }

        return redirect()->to("/peserta/{$id}");
    }
    
    public function peserta_d($id)
    {
        $pesertaModel = new PesertaModel();
        $setoranModel = new SetoranModel();
    
        $peserta = $pesertaModel->find($id);
    
        if (!$peserta) {
            session()->setFlashdata('error', 'Peserta tidak ditemukan.');
            return redirect()->to('/peserta');
        }
    
        $setoranModel->where('peserta_id', $id)->findAll();
        foreach ($setoranModel->where('peserta_id', $id)->findAll() as $setoran) {
            $this->setoran_d($setoran['setoran_id']);
        }
    
        if ($pesertaModel->delete($id)) {
            session()->setFlashdata('success', 'Data peserta atas nama ' . esc($peserta['peserta_nama']) . ' berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus peserta.');
        }
    
        return redirect()->to('/peserta');
    }
    
    public function analitik(): string
    {
        $status = [
            'page' => 'analitik',
            'judul' => 'Analitik Kegiatan'
        ];
    
        $SetoranModel = new SetoranModel();
    
        $bulan = $this->request->getVar('bulan') ?? date('m');
        $tahun = $this->request->getVar('tahun') ?? date('Y');

        $setoranmingguan = $SetoranModel->analitik_setoranmingguan();
        $setoranbulanan = $SetoranModel->analitik_setoranbulanan();
        $setoranbulananfix = $SetoranModel->analitik_setoranbulananfix($bulan, $tahun);
        $setoranall = $SetoranModel->analitik_setoranall();
    
        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/analitik', [
            'setoranmingguan' => $setoranmingguan,
            'setoranbulanan' => $setoranbulanan,
            'setoranbulananfix' => $setoranbulananfix,
            'setoranall' => $setoranall,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]) .
        view('templates/footer');
    }
    
    public function analitik_download_analisisbulanan($bulan = null, $tahun = null)
    {
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');
    
        $SetoranModel = new SetoranModel();
        $dataSetoran = $SetoranModel->select('setoran.created_at, peserta.peserta_kartu, peserta.peserta_nama, setoran.setoran_jumlah, setoran.setoran_keterangan')
            ->join('peserta', 'peserta.peserta_id = setoran.peserta_id')
            ->where('MONTH(setoran.created_at)', $bulan)
            ->where('YEAR(setoran.created_at)', $tahun)
            ->orderBy('setoran.created_at', 'ASC')
            ->findAll();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Judul di baris pertama
        $judul = 'Laporan Analisis Setoran Bulanan (' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun . ')';
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', $judul);
    
        // Styling Judul (warna hijau seperti header)
        $judulStyle = [
            'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'] // Warna hijau seperti header
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A1')->applyFromArray($judulStyle);
        $sheet->getRowDimension(1)->setRowHeight(30);
    
        // Styling Header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A2:H2')->applyFromArray($headerStyle);
    
        // Auto Size Kolom
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Header Kolom (update untuk kolom baru "Pukul")
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Tanggal');
        $sheet->setCellValue('C2', 'Pukul');
        $sheet->setCellValue('D2', 'Nomor Kartu');
        $sheet->setCellValue('E2', 'Nama Peserta');
        $sheet->setCellValue('F2', 'Berat Sampah Perseorangan (Kg)');
        $sheet->setCellValue('G2', 'Keterangan');
        $sheet->setCellValue('H2', 'Berat Sampah Harian (Kg)');

        // Kelompokkan data berdasarkan tanggal
        $groupedData = [];
        foreach ($dataSetoran as $setoran) {
            $dailyKey = date('Y-m-d', strtotime($setoran['created_at']));
            $groupedData[$dailyKey][] = $setoran;
        }

        // Tulis data ke Excel
        $no = 1;
        $row = 3;
        $totalBulanan = 0;

        foreach ($groupedData as $tanggal => $setorans) {
            $totalHarian = 0;
            $startRow = $row;  // Menandai baris awal untuk merge Tanggal

            foreach ($setorans as $setoran) {
                $tanggalFormat = date('d/m/Y', strtotime($setoran['created_at']));  // Hanya tanggal
                $jamFormat = date('H:i', strtotime($setoran['created_at']));       // Hanya jam
                $berat = $setoran['setoran_jumlah'];
                $keterangan = !empty($setoran['setoran_keterangan']) ? $setoran['setoran_keterangan'] : '-';

                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $tanggalFormat);  // Tanggal
                $sheet->setCellValue('C' . $row, $jamFormat);      // Pukul
                $sheet->setCellValue('D' . $row, $setoran['peserta_kartu']);
                $sheet->setCellValue('E' . $row, $setoran['peserta_nama']);
                $sheet->setCellValue('F' . $row, $berat);
                $sheet->setCellValue('G' . $row, $keterangan);

                $totalHarian += $berat;
                $totalBulanan += $berat;
                $row++;
            }

            // Merge kolom Tanggal (B) untuk tanggal yang sama
            $endRow = $row - 1;
            $mergeTanggalRange = 'B' . $startRow . ':B' . $endRow;
            $sheet->mergeCells($mergeTanggalRange);

            // Merge kolom Berat Sampah Harian (H)
            $mergeBeratRange = 'H' . $startRow . ':H' . $endRow;
            $sheet->mergeCells($mergeBeratRange);
            $sheet->setCellValue('H' . $startRow, $totalHarian);

            // Pusatkan teks di kolom yang digabungkan (Tanggal dan Berat Harian)
            $sheet->getStyle($mergeTanggalRange)->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                ]
            ]);
            $sheet->getStyle($mergeBeratRange)->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                ]
            ]);
        }

        // Total Bulanan di kolom H
        $sheet->setCellValue('H' . $row, $totalBulanan);

        // Styling Total Bulanan
        $totalStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF9800']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('H' . $row)->applyFromArray($totalStyle);
    
        // Border untuk Semua Data (A2 sampai baris terakhir)
        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'BFBFBF']]]
        ];
        $sheet->getStyle('A2:H' . $row)->applyFromArray($dataStyle);
    
        // Format Tanggal dan Angka
        $sheet->getStyle('B3:B' . ($row - 1))->getNumberFormat()->setFormatCode('DD/MM/YYYY | hh:mm');
    
        // Output ke File
        $fileName = 'Analisis_Bulanan_' . $bulan . '_' . $tahun . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
    
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    
    public function aturan_reward(): string
    {
        $status = [
            'page' => 'reward',
            'judul' => 'Aturan Reward'
        ];

        $reward = new RewardGolonganModel();
        $rewardall = $reward->getAllReward();

        $groupedRewards = [];
        foreach ($rewardall as $reward) {
            $groupedRewards[$reward['reward_golongan_id']][$reward['reward_golongan_berat']][] = $reward;
        }
    
        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/aturan-reward', [
            'groupedRewards' => $groupedRewards
        ]) .
        view('templates/footer');
    } 
}
