<?php

namespace App\Controllers;

use App\Models\Mmasyarakat;
use App\Models\Mkategori;
use App\Models\Minstansi;
use App\Models\Mpengaduan;
use App\Models\Mhistori;
use App\Models\Mfeedback;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Masyarakat extends BaseController
{
    protected $Mmasyarakat;
    protected $Mkategori;
    protected $Minstansi;
    protected $Mpengaduan;
    protected $Mhistori;
    protected $Mfeedback;
    public function __construct()
    {
        $this->Mmasyarakat = new Mmasyarakat();
        $this->Mkategori = new Mkategori();
        $this->Minstansi = new Minstansi();
        $this->Mpengaduan = new Mpengaduan();
        $this->Mhistori = new Mhistori();
        $this->Mfeedback = new Mfeedback();
    }

    public function index()
    {

        $total_user = $this->Mmasyarakat->countAllResults();
        $total_aduan = $this->Mpengaduan->countAllResults();
        $total_aduan_proses = $this->Mpengaduan->where('status', 'Dalam Proses')->countAllResults();
        $total_aduan_selesai = $this->Mpengaduan->where('status', 'Selesai')->countAllResults();

        $limit = 3;
        $nik = session()->get('nik');

        // Dapatkan halaman saat ini
        $page = $this->request->getVar('page') ?? 1;
        $pengaduan = $this->Mpengaduan->getPengaduanPublik($limit);
        $pager = $this->Mpengaduan->pager;

        $data = [
            'title' => "Home",
            'pengaduan' => $pengaduan,
            'pager' => $pager,
            'total_user' => $total_user,
            'total_pengaduan' => $total_aduan,
            'total_pengaduan_proses' => $total_aduan_proses,
            'total_pengaduan_selesai' => $total_aduan_selesai,
        ];
        return view('masyarakat_pages/v_home_masyarakat', $data);
    }
    public function aduan()
    {
        $limit = 3;
        $nik = session()->get('nik');

        $search = $this->request->getGet('search');
        $instansi_id = $this->request->getGet('instansi');
        $kategori_id = $this->request->getGet('kategori');
        // Dapatkan halaman saat ini
        $page = $this->request->getVar('page') ?? 1;
        $pengaduan = $this->Mpengaduan->getPengaduanPublik($limit);
        $pager = $this->Mpengaduan->pager;
        $kategori = $this->Mkategori->findAll();
        $instansi = $this->Minstansi->findAll();
        $data = [
            'title' => "Daftar Pengaduan",
            'pengaduan' => $pengaduan,
            'pager' => $pager,
            'kategori' => $kategori,
            'instansi' => $instansi,
            'search' => $search, // Pastikan search tetap dikirim ke view
            'instansi_id' => $instansi_id, // Pastikan instansi_id ada di view
            'kategori_id' => $kategori_id,
        ];
        return view('masyarakat_pages/v_aduan_masyarakat', $data);
    }

    public function search()
    {
        $kategori = $this->Mkategori->findAll();
        $instansi = $this->Minstansi->findAll();
        $search = $this->request->getGet('search');
        $instansi_id = $this->request->getGet('instansi');
        $kategori_id = $this->request->getGet('kategori');
        $page = $this->request->getGet('page') ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $pengaduan = $this->Mpengaduan->searchPengaduan($limit, $page, $search, $instansi_id, $kategori_id);
        $totalPengaduan = $this->Mpengaduan->countPengaduann($search, $instansi_id, $kategori_id);

        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $limit, $totalPengaduan);

        $noData = count($pengaduan) == 0;

        // Jika request AJAX, kembalikan hanya bagian tabel
        if ($this->request->isAJAX()) {
            return view('masyarakat_pages/v_listaduan', [
                'title' => "Daftar Pengaduan",
                'pengaduan' => $pengaduan,
                'pager' => $pager,
                'kategori' => $kategori,
                'instansi' => $instansi,
                'instansi_id' => $instansi_id,
                'kategori_id' => $kategori_id,
                'noData' => $noData
            ]);
        }

        return view('masyarakat_pages/v_aduan_masyarakat', [
            'title' => "Daftar Pengaduan",
            'pengaduan' => $pengaduan,
            'pager' => $pager,
            'kategori' => $kategori,
            'instansi' => $instansi,
            'instansi_id' => $instansi_id,
            'kategori_id' => $kategori_id,
            'noData' => $noData
        ]);
    }

    public function buat()
    {
        $kategori = $this->Mkategori->findAll();
        $instansi = $this->Minstansi->findAll();
        $data = [
            'title' => "Buat Aduan",
            'kategori' => $kategori,
            'instansi' => $instansi,
        ];
        return view('masyarakat_pages/v_buataduan_masyarakat', $data);
    }
    public function akunku()
    {
        $limit = 3;
        $nik = session()->get('nik');
        $pengaduanData = $this->Mmasyarakat->where('nik', $nik)->findAll();
        // Dapatkan halaman saat ini

        if (!$pengaduanData) {
            return redirect()->back()->with('error', 'Data pengaduan tidak ditemukan');
        }

        // Karena hasil formulirGet berupa array banyak, kita ambil row pertama
        $masyarakat = $pengaduanData[0];
        $page = $this->request->getVar('page') ?? 1;
        $pengaduan = $this->Mpengaduan->getPengaduan($limit, $nik);
        $pager = $this->Mpengaduan->pager;
        $kat = $this->Mkategori->findAll();
        $ins = $this->Minstansi->findAll();

        $data = [
            'title' => "Profile",
            'pengaduan' => $pengaduan,
            'penggunarow' => $pengaduanData,
            'pengguna1row' => $masyarakat,
            'pager' => $pager,
            'kat' => $kat,
            'ins' => $ins,

        ];
        return view('masyarakat_pages/v_profile_masyarakat', $data);
    }

    public function detail_aduan($id_aduan)
    {

        $nik = session()->get('nik');
        $pengaduanData = $this->Mmasyarakat->where('nik', $nik)->findAll();
        if (!$pengaduanData) {
            return redirect()->back()->with('error', 'Data pengaduan tidak ditemukan');
        }

        // Karena hasil formulirGet berupa array banyak, kita ambil row pertama
        $masyarakat = $pengaduanData[0];

        $pengaduan = $this->Mpengaduan->getAll($id_aduan);
        $timline = $this->Mhistori->getHistoris($id_aduan);
        $feedback = $this->Mfeedback->getFeedback($id_aduan);
        $cek_rowfeedback = $this->Mfeedback->where('id_pengaduan', $id_aduan)->get()->getNumRows();
        $ambil_idfeedback = $this->Mfeedback->where('id_pengaduan', $id_aduan)->get()->getResultArray();


        $data = [
            'title' => "Detail Aduan",
            'pengaduan' => $pengaduan,
            'pengguna1row' => $masyarakat,
            'timline' => $timline,
            'feedback' => $feedback,
            'cek_row' => $cek_rowfeedback,
            'id_pengaduan' => $id_aduan,


        ];
        return view('masyarakat_pages/v_detail_aduan_masyarakat.php', $data);
    }
    public function login()
    {
        return view('masyarakat_pages/v_masuk_masyarakat');
    }
    public function daftar()
    {
        return view('masyarakat_pages/v_daftar_masyarakat');
    }

    public function proses_login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Cek sesuai level yang dipilih
        // Cek di tabel pengajar
        $masyarakat = $this->Mmasyarakat->where('email', $username)->first();

        if ($masyarakat && password_verify($password, $masyarakat['password'])) {
            // Jika cocok, set session pengajar
            $session->set([
                'nik' => $masyarakat['nik'],
                'nama' => $masyarakat['nama_pengadu'],
                'email' => $masyarakat['email'],
                'alamat' => $masyarakat['alamat'],
                'tgl_lahir' => $masyarakat['tgl_lahir'],
                'no_telpon' => $masyarakat['no_telpon'],
                'pekerjaan' => $masyarakat['pekerjaan'],
                'kampus' => $masyarakat['kampus'],
                'jurusan' => $masyarakat['jurusan'],
                'instansi' => $masyarakat['instansi'],
                'jabatan' => $masyarakat['jabatan'],
                'role' => $masyarakat['level'],
                'logged_in_mas' => true
            ]);
            $session->setFlashdata('pesanlogin', 'Berhasil Masuk');
            return redirect()->to('masyarakat/profile'); // Redirect ke dashboard Admin
        }

        // Jika login gagal
        $session->setFlashdata('error', 'Username atau password Tidak Sesuai');
        return redirect()->back()->withInput(); // Kembali ke halaman login
    }
    public function proses_resetpass($id_mas)
    {
        $password = $this->request->getVar('password');
        $data = [
            'nik' => $id_mas,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $this->Mmasyarakat->save($data);
        session()->setFlashdata('pesan_aduan', 'Berhasil Reset');
        return redirect()->back()->withInput(); // Kembali ke halaman
    }
    public function proses_update_data_profile($id_mas)
    {
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
        $nohp = $this->request->getVar('nohp');
        $data = [
            'nik' => $id_mas,
            'nama_pengadu' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $nohp,
        ];
        $this->Mmasyarakat->save($data);
        session()->setFlashdata('pesan_aduan', 'Berhasil Update Data');
        return redirect()->back()->withInput(); // Kembali ke halaman
    }
    public function proses_regis()
    {
        // Mengambil data dari form
        $nik = $this->request->getVar('nik');
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $tgl_lahir = $this->request->getVar('tgl_lahir');
        $jenkel = $this->request->getVar('jenkel');
        $no = $this->request->getVar('notelp');
        $password = $this->request->getVar('password');
        $alamat = $this->request->getVar('alamat');
        $pekerjaan = $this->request->getVar('pekerjaan');
        $kampus = $this->request->getVar('kampus');
        $jurusan = $this->request->getVar('jurusan');
        $instansi = $this->request->getVar('instansi');
        $jabatan = $this->request->getVar('jabatan');

        $confirm_password = $this->request->getVar('confirm_password');
        $setuju = $this->request->getVar('setuju'); // Checkbox untuk syarat dan ketentuan
        $warga_kabila = $this->request->getVar('warga_kabila'); // Checkbox untuk warga kecamatan Kabila

        // Validasi checkbox
        if (!$setuju) {
            return redirect()->back()->withInput()->with('error', 'Anda harus menyetujui syarat dan ketentuan.');
        }

        // Validasi NIK dan panjang password
        if (strlen($nik) != 16) {
            return redirect()->back()->withInput()->with('error', 'NIK harus terdiri dari 16 digit.');
        }

        if ($password !== $confirm_password) {
            return redirect()->back()->withInput()->with('error', 'Password dan konfirmasi password tidak cocok.');
        }

        // Validasi Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }

        // Cek apakah email sudah terdaftar
        if ($this->Mmasyarakat->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Email sudah terdaftar.');
        }

        // Tentukan nilai untuk 'level' berdasarkan checkbox warga_kabila
        $level = $warga_kabila ? 'warga' : 'tamu'; // Jika dicentang 'warga', jika tidak 'tamu'

        // Proses penyimpanan data pengguna
        $this->Mmasyarakat->save([
            'nik' => $nik,
            'nama_pengadu' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Simpan password yang sudah di-hash
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'no_telpon' => $no,
            'jenis_kelamin' => $jenkel,
            'pekerjaan' => $pekerjaan,
            'kampus' => $kampus,
            'jurusan' => $jurusan,
            'instansi' => $instansi,
            'jabatan' => $jabatan,
            'level' => $level, // Simpan level berdasarkan checkbox
        ]);

        // Redirect ke halaman login setelah sukses
        return redirect()->to('/daftar_masyarakat')->with('berhasil', 'Registrasi berhasil, silakan login.');
    }

    public function keluar_masyarakat()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    public function masyarakat()
    {
        return view('masyarakat_pages/v_dashboard_masyarakat');
    }

    public function proses_buat_aduan()
    {
        $judul = $this->request->getVar('judul');
        $isi = $this->request->getVar('isi');
        $masyarakat = $this->request->getVar('masyarakat');
        $kategori = $this->request->getVar('kategori');
        $instansi = $this->request->getVar('instansi');
        $tipeaduan = $this->request->getVar('tipeaduan');
        // 1. Validasi File & Input Dasar
        $rules = [
            'judul'     => 'required|min_length[5]',
            'isi'       => 'required',
            'kategori'  => 'required',
            'instansi'  => 'required',
            'tipeaduan' => 'required',
            'filefoto'  => [
                'rules' => 'is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/gif,image/png]|max_size[filefoto,2048]',
                'errors' => [
                    'mime_in' => 'Format file harus jpg, jpeg, gif, atau png',
                    'max_size' => 'Ukuran file maksimal 2 MB',
                ]
            ]
        ];
        $messages = [
            'judul' => [
                'required'   => 'Judul aduan wajib diisi.',
                'min_length' => 'Judul minimal harus 5 karakter.'
            ],
            'isi' => [
                'required' => 'Isi laporan tidak boleh kosong.'
            ],
            'kategori' => [
                'required' => 'Silakan pilih kategori laporan.'
            ],
            'instansi' => [
                'required' => 'Silakan pilih instansi tujuan.'
            ],
            'tipeaduan' => [
                'required' => 'Pilih salah satu tipe aduan (Umum/Anonim/Rahasia).'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // ehndel upload
        $Berkasfoto = $this->request->getFile('filefoto');
        // jika form foto kosong
        if ($Berkasfoto->getError() == 4) {
            $filefoto = 'blank.jpg';
        } else {
            $filefoto = $Berkasfoto->getRandomName();
            $Berkasfoto->move('foto_laporan/', $filefoto);
        }
        $email_tujuan = session()->get('email');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $link = base_url("profile");
        $email->setMessage("Pengaduan Anda telah berhasil diajukan dan menunggu proses verifikasi dari pihak kecamatan. Mohon bersabar, kami akan segera menindaklanjuti laporan Anda. <br> klik link berikut untuk mengecek detail aduan kamu: <a href='$link'>$link</a>");
        $email->send();
        $data = [
            'judul' => $judul,
            'isi' => $isi,
            'id_masyarakat' => $masyarakat,
            'id_kategori' => $kategori,
            'id_instansi' => $instansi,
            'foto' => $filefoto,  // Menyimpan nama file
            'status' => 'Diajukan', // Status awal
            'tipe_aduan' => $tipeaduan,
        ];
        $this->Mpengaduan->save($data);
        $id_pengadu = $this->Mpengaduan->getLastID();
        $data_historis = [
            'id_pengaduan' => $id_pengadu,
            'isi' => $isi,
            'status' => 'Diajukan',
            'keterangan' => 'Pengaduan Anda telah berhasil diajukan dan menunggu proses verifikasi dari pihak kecamatan. Mohon bersabar, kami akan segera menindaklanjuti laporan Anda.'
        ];
        $this->Mhistori->save($data_historis);
        session()->setFlashdata('pesan_aduan', 'Pengaduan Berhasil Diajukan');
        return redirect()->to('masyarakat/buataduan');
    }

    public function proses_feedback()
    {
        $data = ['id_pengaduan' => $this->request->getVar('id_pengaduan'), 'feedback' => $this->request->getVar('feed')];
        $this->Mfeedback->save($data);
        session()->setFlashdata('pesan_aduan', 'Pesan Terkirim');
        return redirect()->back()->withInput();
    }
    public function proses_edit_feedback($id_feedback)
    {
        $data = ['id_feedback' => $id_feedback, 'id_pengaduan' => $this->request->getVar('id_pengaduan'), 'feedback' => $this->request->getVar('feed')];
        $this->Mfeedback->save($data);
        session()->setFlashdata('pesan_aduan', 'Pesan Berhasil Diperbaharui');
        return redirect()->back()->withInput();
    }

    //controller download
    public function download($namaFile)
    {
        // Path ke file di folder public/documents
        $filePath = FCPATH . 'bukti_pengaduan/' . $namaFile;

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Menggunakan helper download bawaan CI4
        return $this->response->download($filePath, null);
    }

    public function panduan()
    {
        // Path ke file di folder public/documents
        $filePath = FCPATH . 'panduan/panduan-pengaduan.pdf';

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Menggunakan helper download bawaan CI4
        return $this->response->download($filePath, null);
    }

    public function viewpanduan()
    {
        $data = [
            'title' => 'Panduan'
        ];
        return view('masyarakat_pages/v_panduan', $data);
    }
}
