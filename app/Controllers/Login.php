<?php

namespace App\Controllers;

use App\Models\Madmin;
use App\Models\Minstansi;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $Madmin;
    protected $Minstansi;
    public function __construct()
    {
        $this->Madmin = new Madmin();
        $this->Minstansi = new Minstansi();
    }
    public function index()
    {
        return view('v_login');
    }

    public function proses_login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');

        // Cek sesuai level yang dipilih
        if ($level == 'admin') {
            // Cek di tabel pengajar
            $admin = $this->Madmin->where('username', $username)->where('level', $level)->first();

            if ($admin && password_verify($password, $admin['password'])) {
                // Jika cocok, set session pengajar
                $session->set([
                    'admin_id' => $admin['id_admin'],
                    'instansi_id' => $admin['id_instansi'],
                    'nama' => $admin['nama_admin'],
                    'username' => $admin['username'],
                    'level' => 'admin',
                    'logged_in_admin' => true
                ]);
                $session->setFlashdata('pesanlogin', 'Berhasil Masuk');
                return redirect()->to('admin/dashboard'); // Redirect ke dashboard Admin
            }
        } elseif ($level == 'operator') {
            // Cek di tabel admin
            $operator = $this->Madmin->where('username', $username)->where('level', $level)->first();

            if ($operator && password_verify($password, $operator['password'])) {
                // Jika cocok, set session admin
                $session->set([
                    'admin_id' => $operator['id_admin'],
                    'instansi_id' => $operator['id_instansi'],
                    'nama' => $operator['nama_admin'],
                    'username' => $operator['username'],
                    'level' => 'operator',
                    'logged_in_admin' => true
                ]);
                $session->setFlashdata('pesanlogin', 'Berhasil Masuk');
                return redirect()->to('admin/dashboard'); // Redirect ke dashboard Operator
            }
        }

        // Jika login gagal
        $session->setFlashdata('pesanlogin', 'Username, password, atau level Tidak Sesuai');
        return redirect()->back()->withInput(); // Kembali ke halaman login
    }

    public function keluar()
    {
        session()->destroy();
        return redirect()->to(base_url('masuk_admin'));
    }

    public function buat()
    {
        $instansi = $this->Minstansi->findAll();
        $data = [
            'instansi' => $instansi
        ];
        return view('v_registrasi', $data);
    }

    public function proses_buat()
    {
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $konfirmasi_password = $this->request->getVar('konfirmasi_password');
        $instansi = $this->request->getVar('instansi');
        //cek email tidak bisa sama
        $email = $this->Madmin->where('username', $username)->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email Sudah Terdaftar!');
        } else {
            // Validasi password
            if ($password != $konfirmasi_password) {
                return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak cocok!');
            }
            $this->Madmin->save([
                'id_instansi' => $instansi,
                'nama_admin' => $nama,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => 'Operator'
            ]);
            session()->setFlashdata('pesanbuat', 'Berhasil Mendaftar');
            return redirect()->to('masuk_admin');
        }
    }
}
