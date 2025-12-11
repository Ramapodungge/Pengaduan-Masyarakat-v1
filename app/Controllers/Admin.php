<?php

namespace App\Controllers;

use App\Models\Mmasyarakat;
use App\Models\Mkategori;
use App\Models\Minstansi;
use App\Models\Mpengaduan;


use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    protected $Mmasyarakat;
    protected $Mkategori;
    protected $Minstansi;
    protected $Mpengaduan;
    public function __construct()
    {
        $this->Mmasyarakat = new Mmasyarakat();
        $this->Mkategori = new Mkategori();
        $this->Minstansi = new Minstansi();
        $this->Mpengaduan = new Mpengaduan();
    }
    public function index()
    {
        if (session()->has('logged_in') and session()->get('logged_in') == true) {

            $total_pengaduan = $this->Mpengaduan->getTotalPengaduan();
            $pengaduan_baru = $this->Mpengaduan->getPengaduanTerbaru();
            $pengaduan_permasyarakat = $this->Mpengaduan->getPengaduanByMasyarakat();
            $pengaduan_perKategori = $this->Mpengaduan->getPengaduanByKategori();
            $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
            $total_masyarakat = $this->Mmasyarakat->countAll();

            //DASHBOARD MASYARAKAT
            $id_instansi = session()->get('instansi_id');
            $total_pengaduanOP = $this->Mpengaduan->getTotalPengaduanOP($id_instansi);
            $pengaduan_permasyarakatOP = $this->Mpengaduan->getPengaduanByMasyarakatOP($id_instansi);
            $pengaduan_perKategoriOP = $this->Mpengaduan->getPengaduanByKategoriOP($id_instansi);



            $data = [
                'title' => 'Dashboard',
                'total_pengaduan' => $total_pengaduan,
                'total_pengaduanOP' => $total_pengaduanOP,
                'berdasarkan_masyarakat' => $pengaduan_permasyarakat,
                'berdasarkan_masyarakatOP' => $pengaduan_permasyarakatOP,
                'berdasarkan_kategori' => $pengaduan_perKategori,
                'berdasarkan_kategoriOP' => $pengaduan_perKategoriOP,
                'pengaduan_perstatus' => $pengaduan_perstatus,
                'pengaduan_baru' => $pengaduan_baru,
                'total_masyarakat' => $total_masyarakat,
            ];
            return view('admin_pages/v_dashboard', $data);
        } else {
            session()->setFlashdata('pesanlogindulu', 'Anda Harus Login');
            return redirect()->to(base_url('masuk_admin'));
        }
    }
    public function laporan_masyarakat()
    {
        if (session()->has('logged_in') and session()->get('logged_in') == true) {
            if (session()->get('level') == 'admin') {
                $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

                $data = [
                    'title' => 'Laporan Masyarakat',
                    'masyarakat' => $this->Mmasyarakat->findAll()
                ];
                $v1 = view('laporan/laporan_masyarakat', $data);
                $mpdf->WriteHTML($v1);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output('Surat Pernyataan.pdf', 'I');
            } else {
                session()->setFlashdata('pesanloginerr', 'Jangan Nakal Yaaaa!!');
                return redirect()->to(base_url('/dashboard'));
            }
        } else {
            session()->setFlashdata('pesanlogindulu', 'Anda Harus Login');
            return redirect()->to(base_url('masuk_admin'));
        }
    }
    public function laporan_pengaduan()
    {
        if (session()->has('logged_in') and session()->get('logged_in') == true) {
            $pengaduan = $this->Mpengaduan->semuaPengaduan();
            $instansi_id = session()->get('instansi_id');
            $pengaduanOP = $this->Mpengaduan->semuaPengaduanOP($instansi_id);
            $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

            $data = [
                'title' => 'Laporan Pengaduan',
                'masyarakat' => $this->Mmasyarakat->findAll(),
                'pengaduan' => $pengaduan,
                'pengaduanOP' => $pengaduanOP
            ];
            $v1 = view('laporan/laporan_pengaduan', $data);
            $mpdf->WriteHTML($v1);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output('Surat Pernyataan.pdf', 'I');
        } else {
            session()->setFlashdata('pesanlogindulu', 'Anda Harus Login');
            return redirect()->to(base_url('masuk_admin'));
        }
    }
    public function formulir($id_pengaduan)
    {
        if (session()->has('logged_in') and session()->get('logged_in') == true) {
            $dataPengaduan = $this->Mpengaduan->formulirGet($id_pengaduan);

            if (!$dataPengaduan) {
                return redirect()->back()->with('error', 'Data pengaduan tidak ditemukan');
            }

            // Karena hasil formulirGet berupa array banyak, kita ambil row pertama
            $pengaduan = $dataPengaduan[0];
            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

            $data = [
                'title' => 'Formulir Masyarakat',
                'masyarakat' => $this->Mmasyarakat->findAll(),
                'pengaduan' => $pengaduan,
                'organization_name' => 'Sistem Pelaporan Pengaduan',
                'organization_address' => 'Jl. Contoh No. 123, Indonesia',
                'organization_contact' => 'Telp: 0812-0000-0000',
                'logo_path' => FCPATH . 'bonebolango.png', // ubah jika berbeda
            ];
            $v1 = view('laporan/formulir_pengaduan', $data);
            $mpdf->WriteHTML($v1);
            $mpdf->AddPage();

            //halam lampiran
            //halaman 2
            $v2 = view('laporan/lampiran_formulir', $data);
            $mpdf->WriteHTML($v2);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output('Surat Pernyataan.pdf', 'I');
        } else {
            session()->setFlashdata('pesanlogindulu', 'Anda Harus Login');
            return redirect()->to(base_url('masuk_admin'));
        }
    }

    public function filter()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        if (empty($bulan) && empty($tahun)) {
            return $this->response->setStatusCode(400)->setBody('Bulan atau Tahun harus dipilih');
        }

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $instansi_id = session()->get('instansi_id');

        // Mengambil data pengaduan berdasarkan filter
        if ($bulan && $tahun) {
            $data['pengaduan'] = $this->Mpengaduan->filterByMonthYear($bulan, $tahun);
        } else if ($bulan) {
            $data['pengaduan'] = $this->Mpengaduan->filterByMonth($bulan);
        } else if ($tahun) {
            $data['pengaduan'] = $this->Mpengaduan->filterByYear($tahun);
        } else {
            $data['pengaduan'] = $this->Mpengaduan->getAllWithJoins();
        }

        // Jika permintaan AJAX, kirimkan hasil dalam bentuk HTML
        if ($this->request->isAJAX()) {
            return view('laporan/_filtered_pengaduan_table', $data);  // Kirim data dalam bentuk HTML untuk menampilkan tabel
        }
        log_message('error', 'Bulan: ' . $bulan . ' Tahun: ' . $tahun);
        return view('laporan/filter_pengaduan', $data);
    }

    public function filterPDF()
    {
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $instansi_id = session()->get('instansi_id');

        if (session()->get('level') == 'admin') {

            if ($bulan || $tahun) {
                $data['pengaduan'] = $this->Mpengaduan->filterByMonthYear($bulan, $tahun);
            } else {
                $data['pengaduan'] = $this->Mpengaduan->getAllWithJoins();
            }
        }
        if (session()->get('level') == 'operator') {

            if ($bulan || $tahun) {
                $data['pengaduan'] = $this->Mpengaduan->filterByMonthYearOP($bulan, $tahun, $instansi_id);
            } else {

                $data['pengaduan'] = $this->Mpengaduan->semuaPengaduanOP($instansi_id);
            }
        }



        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $html = view('laporan/filter_pengaduan', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Surat Pernyataan.pdf', 'I');
    }
}
