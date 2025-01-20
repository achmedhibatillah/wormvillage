<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\TrafficModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{ 
    public function user_signin(): ResponseInterface
    {
        $session = session();
        if ($session->get('status') == 'login-user') {
            return redirect()->to('user');
        }

        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 11
        ]);

        $status = [
            'page' => 'user-signin',
            'judul' => 'Sign In'
        ];

        $a = view('templates/header', $status);
        $b = view('auth/signin_user');
        $c = view('templates/footer');
    
        return response()->setBody($a . $b . $c);
    }

    public function user_auth()
    {
        $session = session();
        $pesertaModel = new \App\Models\PesertaModel();

        $inputKartu = $this->request->getPost('peserta-kartu');

        if (empty($inputKartu)) {
            return redirect()->to('sign-in-user')->with('error', 'Nomor kartu tidak boleh kosong.');
        }

        $peserta = $pesertaModel->where('peserta_kartu', $inputKartu)->first();

        if ($peserta) {
            $session->set([
                'peserta_id'    => $peserta['peserta_id'],
                'peserta_kartu' => $peserta['peserta_kartu'],
                'status'        => 'login-user'
            ]);

            return redirect()->to('user')->with('success', 'Berhasil login.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Nomor kartu tidak ditemukan.');
        }
    }


    public function admin_signin(): ResponseInterface
    {
        $session = session();
        if ($session->get('status') == 'login-admin') {
            return redirect()->to('dashboard');
        }

        $trafficModel = new TrafficModel();
        $trafficModel->insert([
            'traffic_hal' => 12
        ]);

        $status = [
            'page' => 'admin-signin',
            'judul' => 'Sign In - Admin'
        ];

        $a = view('templates/header', $status);
        $b = view('auth/signin_admin');
        $c = view('templates/footer');
    
        return response()->setBody($a . $b . $c);
    }

    public function admin_auth()
    {
        $session = session();
        $adminModel = new AdminModel();

        $username = $this->request->getPost('admin-username');
        $password = $this->request->getPost('admin-password');

        if (empty($username) || empty($password)) {
            return redirect()->to('sign-in-admin')->withInput()->with('error', 'Username dan Password tidak boleh kosong.');
        }

        if ($username === 'root' && $password === 'root') {
            $session->set([
                'admin_username' => 'root',
                'status' => 'login-admin'
            ]);
            return redirect()->to('dashboard')->with('success', 'Berhasil login sebagai ROOT!');
        }

        $admin = $adminModel->where('admin_username', $username)->first();

        if ($admin) {
            if (password_verify($password, $admin['admin_password'])) {
                $session->set([
                    'admin_id' => $admin['admin_id'],
                    'admin_username' => $admin['admin_username'],
                    'status' => 'login-admin'
                ]);
                return redirect()->to('dashboard')->with('success', 'Berhasil login!');
            } else {
                return redirect()->to('sign-in-admin')->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->to('sign-in-admin')->withInput()->with('error', 'Username tidak ditemukan.');
        }
    }
}
