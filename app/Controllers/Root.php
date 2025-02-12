<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RewardBarangModel;
use App\Models\RewardGolonganModel;
use App\Models\TrafficModel;
use App\Models\HeroModel;

use CodeIgniter\HTTP\ResponseInterface;

class Root extends BaseController
{
    public function __construct()
    {
        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 23
        ]);
    }

    public function root(): ResponseInterface
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $status = [
            'page' => 'root',
            'judul' => 'Manajemen Admin'
        ];

        $admin = new AdminModel();
        $adminall = $admin->orderBy('created_at', 'DESC')->findAll();

        $header = view('templates/header', $status);
        $navbar = view('templates/navbar_admin', $status);
        $content = view('admin/root', ['adminall' => $adminall]);
        $footer = view('templates/footer');
    
        return response()->setBody($header . $navbar . $content . $footer);
    }

    public function admin_tambah(): ResponseInterface
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $status = [
            'page' => 'root',
            'judul' => 'Tambah Admin'
        ];

        $header = view('templates/header', $status);
        $navbar = view('templates/navbar_admin', $status);
        $content = view('admin/root-admin-tambah');
        $footer = view('templates/footer');
    
        return response()->setBody($header . $navbar . $content . $footer);
    }

    public function admin_a()
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $validationRules = [
            'admin-username' => 'required|min_length[4]|is_unique[admin.admin_username]|regex_match[/^[a-zA-Z0-9._]+$/]|not_in_list[root]',
            'admin-password' => 'required|min_length[6]',
            'admin-password-2' => 'required|matches[admin-password]'
        ];
        
        $validationMessages = [
            'admin-username' => [
                'required'    => 'Username wajib diisi.',
                'min_length'  => 'Username minimal 4 karakter.',
                'is_unique'   => 'Username sudah digunakan, coba yang lain.',
                'regex_match' => 'Username hanya boleh huruf, angka, titik (.), dan underscore (_), tanpa spasi.',
                'not_in_list' => 'Username tersebut tidak diperbolehkan.'
            ],
            'admin-password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.'
            ],
            'admin-password-2' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak cocok dengan password.'
            ]
        ];              
    
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }        
    
        $username = $this->request->getPost('admin-username');
        $password = password_hash($this->request->getPost('admin-password'), PASSWORD_BCRYPT);
    
        $adminModel = new AdminModel();
        $adminModel->insert([
            'admin_username' => $username,
            'admin_password' => $password
        ]);
    
        return redirect()->to('root')->with('success', 'Admin baru dengan username @' . $username . ' berhasil ditambahkan.');
    }
      
    public function admin_d($id)
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->find($id);
        
        if (!$admin) {
            return redirect()->to('root')->with('error', 'Admin tidak ditemukan.');
        }

        if ($adminModel->delete($id)) {
            return redirect()->to('root')->with('success', 'Admin dengan username @' . esc($admin['admin_username']) . ' berhasil dihapus.');
        } else {
            return redirect()->to('root')->with('error', 'Terjadi kesalahan saat menghapus admin.');
        }
    }

    public function reward(): ResponseInterface
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $status = [
            'page' => 'reward',
            'judul' => 'Pengaturan Reward'
        ];

        $reward = new RewardGolonganModel();
        $rewardall = $reward->getAllReward();

        $groupedRewards = [];
        foreach ($rewardall as $reward) {
            $groupedRewards[$reward['reward_golongan_id']][$reward['reward_golongan_berat']][] = $reward;
        }

        $header = view('templates/header', $status);
        $navbar = view('templates/navbar_admin', $status);
        $content = view('admin/reward', ['groupedRewards' => $groupedRewards]);
        $footer = view('templates/footer');
    
        return response()->setBody($header . $navbar . $content . $footer);
    } 

    public function reward_edit($reward_golongan_id): ResponseInterface
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }
    
        $status = [
            'page' => 'reward',
            'judul' => 'Edit Reward'
        ];
    
        $golonganModel = new RewardGolonganModel();
        $golongan = $golonganModel->find($reward_golongan_id);
    
        $rewardall = $golonganModel->getRewardById($reward_golongan_id);
    
        if (empty($rewardall)) {
            session()->setFlashdata('info', 'Tidak ada reward untuk golongan ini.');
            return redirect()->to('reward-golongan-list');
        }
    
        $groupedRewards = [];
        foreach ($rewardall as $reward) {
            $groupedRewards[$reward['reward_golongan_id']][$golongan['reward_golongan_berat']][] = $reward;
        }
    
        $header = view('templates/header', $status);
        $navbar = view('templates/navbar_admin', $status);
        $content = view('admin/reward-edit', [
            'golongan' => $golongan, 
            'groupedRewards' => $groupedRewards
        ]);
        $footer = view('templates/footer');
    
        return response()->setBody($header . $navbar . $content . $footer);
    }

    public function reward_a_golongan()
    {
        if (!$this->validate([
            'reward_golongan_berat' => 'required|decimal|is_unique[reward_golongan.reward_golongan_berat]',
        ], [
            'reward_golongan_berat' => [
                'required' => 'Isi dengan angka yang valid.',
                'decimal' => 'Isi dengan angka yang valid.',
                'is_unique' => 'Stempel yang Anda isi tidak boleh sama dengan yang ada.'
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }        

        $rewardGolonganBerat = $this->request->getPost('reward_golongan_berat');

        $golonganModel = new RewardGolonganModel();
        $golonganModel->save([
            'reward_golongan_berat' => $rewardGolonganBerat
        ]);

        $rewardGolonganId = $golonganModel->getInsertID();
        
        $barangModel = new RewardBarangModel();
        $barangModel->save([
            'reward_barang_barang' => 'Reward default',
            'reward_golongan_id' => $rewardGolonganId
        ]);

        session()->setFlashdata('success', 'Golongan baru berhasil ditambahkan.');

        return redirect()->to('pengaturan-reward');
    }

    public function reward_d_golongan($id)
    {
        $model = new RewardGolonganModel();
    
        $golongan = $model->find($id);
    
        if (!$golongan) {
            session()->setFlashdata('error', 'Golongan tidak ditemukan.');
            return redirect()->to('pengaturan-reward');
        }
    
        $model->where('reward_golongan_id', $id)->delete();
    
        session()->setFlashdata('success', 'Golongan dan semua reward terkait berhasil dihapus.');
        return redirect()->to('pengaturan-reward');
    }
    
    public function reward_u_berat($golonganId)
    {
        if (!$this->validate([
            'reward_golongan_berat' => 'required|decimal|is_unique[reward_golongan.reward_golongan_berat]',
        ], [
            'reward_golongan_berat' => [
                'required' => 'Isi dengan angka yang valid.',
                'decimal' => 'Isi dengan angka yang valid.',
                'is_unique' => 'Stempel yang Anda isi tidak boleh sama dengan yang ada.'
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }        
    
        $newBerat = $this->request->getPost('reward_golongan_berat');
        $model = new RewardGolonganModel();
        $model->update($golonganId, [
            'reward_golongan_berat' => $newBerat
        ]);
    
        session()->setFlashdata('success-berat', 'Jumlah stempel minimum berhasil diubah.');
        return redirect()->to('edit-reward/' . $golonganId);
    }

    public function reward_a_barang()
    {
        if (!$this->validate([
            'reward_barang_barang' => 'required|string|max_length[100]',
        ], [
            'reward_barang_barang' => [
                'required' => 'Nama barang tidak boleh kosong.',
                'string' => 'Nama barang harus berupa teks.',
                'max_length' => 'Nama barang maksimal 100 karakter.'
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors-barang', $this->validator->getErrors());
        }

        $rewardBarang = $this->request->getPost('reward_barang_barang');
        $golonganId = $this->request->getPost('golonganId');

        $model = new RewardBarangModel();
        $model->save([
            'reward_barang_barang' => $rewardBarang,
            'reward_golongan_id' => $golonganId,
        ]);

        session()->setFlashdata('success-barang', 'Reward baru berhasil ditambahkan.');
        return redirect()->to('edit-reward/' . $golonganId);
    }

    public function reward_u_barang($rewardBarangId)
    {
        if (!$this->validate([
            'reward_barang_barang' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors-u-barang', $this->validator->getErrors());
        }
    
        $newRewardBarang = $this->request->getPost('reward_barang_barang');
        $golonganId = $this->request->getPost('golonganId');
    
        $model = new RewardBarangModel();
        $model->update($rewardBarangId, [
            'reward_barang_barang' => $newRewardBarang
        ]);
    
        session()->setFlashdata('success-u-barang-'.$rewardBarangId, 'Reward berhasil diperbarui.');
        return redirect()->to('edit-reward/' . $golonganId);
    }

    public function reward_d_barang($id, $golonganId)
    {
        $model = new RewardBarangModel();
        $rewardBarang = $model->find($id);

        if (!$rewardBarang) {
            session()->setFlashdata('error-d-barang', 'Reward barang tidak ditemukan.');
            return redirect()->to('edit-reward');
        }
        
        $rewardCount = $model->getRewardById($golonganId);

        if (count($rewardCount) <= 1) {
            session()->setFlashdata('error-d-barang', 'Tidak bisa menghapus reward karena hanya tersisa satu reward barang dalam golongan ini.');
            return redirect()->to('edit-reward/' . $golonganId);
        }

        if ($model->delete($id)) {
            session()->setFlashdata('success-d-barang', 'Berhasil menghapus reward.');
        } else {
            session()->setFlashdata('error-d-barang', 'Gagal menghapus reward barang.');
        }

        return redirect()->to('edit-reward/' . $golonganId);
    }
    
    public function konten(): mixed
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $status = [
            'page' => 'konten',
            'judul' => 'Manajemen Konten'
        ];

        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/root-index') .
        view('templates/footbar_admin') .
        view('templates/footer');
    }

    public function edit_aboutus(): mixed
    {
        $session = session();
        if ($session->get('admin_username') !== 'root') {
            return redirect()->to('dashboard');
        }

        $status = [
            'page' => 'konten',
            'judul' => 'Edit About Us'
        ];

        $heroModel = new HeroModel();
        $hero = $heroModel->find(1);

        return 
        view('templates/header', $status) .
        view('templates/navbar_admin', $status) .
        view('admin/root-edit-about-us', [
            'hero' => $hero
        ]) .
        view('templates/footbar_admin') .
        view('templates/footer');
    }

    public function save_aboutus()
    {
        $update = [
            'hero_isi' => $this->request->getPost('hero_isi'),
        ];

        $heroModel = new HeroModel();
        $heroModel->update(1, $update);

        return redirect()->back()->with('success-save', 'Anda berhasil menyimpan pembaharuan data!');
    }
}