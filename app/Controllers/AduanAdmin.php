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

class AduanAdmin extends BaseController
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

        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $aduandiajukan = $this->Mpengaduan->getAduanDiajukan();
        $aduanterverifikasi = $this->Mpengaduan->getAduanTerverifikasi();
        $aduandialokasi = $this->Mpengaduan->getAduanDialokasi();
        $aduandalamproses = $this->Mpengaduan->getAduanDalamProses();
        $aduanselesai = $this->Mpengaduan->getAduanSelesai();
        $aduanditolak = $this->Mpengaduan->getAduanDitolak();
        $data = [
            'title' => 'Pengaduan',
            'diajukan' => $aduandiajukan,
            'terverifikasi' => $aduanterverifikasi,
            'dialokasi' => $aduandialokasi,
            'dalamproses' => $aduandalamproses,
            'selesai' => $aduanselesai,
            'ditolak' => $aduanditolak,
            'pengaduan_perstatus' => $pengaduan_perstatus,

        ];
        return view('admin_pages/v_pengaduan', $data);
    }
    public function operatoraduan()

    {

        $get_id = session()->get('instansi_id');
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $aduandialokasi = $this->Mpengaduan->getAduanDialokasiOP($get_id);
        $aduandalamproses = $this->Mpengaduan->getAduanDalamProsesOP($get_id);
        $aduanselesai = $this->Mpengaduan->getAduanSelesaiOP($get_id);
        $data = [
            'title' => 'Pengaduan',
            'dialokasi' => $aduandialokasi,
            'dalamproses' => $aduandalamproses,
            'selesai' => $aduanselesai,
            'pengaduan_perstatus' => $pengaduan_perstatus,

        ];
        return view('admin_pages/v_pengaduanoperator', $data);
    }

    public function detail($id_aduan)

    {
        $isntansi = $this->Minstansi->findAll();
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $pengaduan = $this->Mpengaduan->getAll($id_aduan);
        $timline = $this->Mhistori->getHistoris($id_aduan);
        $feedback = $this->Mfeedback->getFeedback($id_aduan);
        $data = [
            'title' => 'Pengaduan',
            'aduan' => $pengaduan,
            'pengaduan_perstatus' => $pengaduan_perstatus,
            'timline' => $timline,
            'feedback' => $feedback,
            'alokasi' => $isntansi

        ];
        return view('admin_pages/v_detail_pengaduan', $data);
    }

    public function proses_terima($id_pengaduan)
    {
        $email_tujuan = $this->request->getVar('email');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $email->setMessage('Pengaduan Anda telah diverifikasi oleh pihak kecamatan. Pengaduan akan segera dialokasikan ke instansi terkait.');
        $email->send();
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'status' => 'Terverifikasi'
        ];
        $this->Mpengaduan->save($data);

        $datahistori = [
            'id_pengaduan' => $id_pengaduan,
            'status' => "Terverifikasi",
            'keterangan' => 'Pengaduan Anda telah diverifikasi oleh pihak kecamatan. Pengaduan akan segera dialokasikan ke instansi terkait.'
        ];
        $this->Mhistori->save($datahistori);
        session()->setFlashdata('pesansimpan', 'Pengaduan Berhasil Diterima');
        return redirect()->back()->withInput();
    }
    public function proses_alokasi($id_pengaduan)
    {
        $id_instansi = $this->request->getVar('instansi_id');
        $email_tujuan = $this->request->getVar('email');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $email->setMessage('Pengaduan Anda telah dialokasikan ke instansi yang sesuai, dan sedang menunggu tindak lanjut dari pihak terkait.');
        $email->send();
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'id_instansi' => $id_instansi,
            'status' => 'Dialokasi'
        ];
        $this->Mpengaduan->save($data);

        $datahistori = [
            'id_pengaduan' => $id_pengaduan,
            'status' => "Dialokasi",
            'keterangan' => 'Pengaduan Anda telah dialokasikan ke instansi yang sesuai, dan sedang menunggu tindak lanjut dari pihak terkait.'
        ];
        $this->Mhistori->save($datahistori);
        session()->setFlashdata('pesansimpan', 'Pengaduan Berhasil Dialoksaikan Ke Instansi Tujuan');
        return redirect()->back()->withInput();
    }
    public function proses_pengadu($id_pengaduan)
    {
        $email_tujuan = $this->request->getVar('email');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $email->setMessage('Pengaduan Anda sedang dalam proses peninjauan atau penanganan oleh pihak instansi. Kami akan menginformasikan kembali setelah proses selesai.');
        $email->send();
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'status' => 'Dalam Proses'
        ];
        $this->Mpengaduan->save($data);

        $datahistori = [
            'id_pengaduan' => $id_pengaduan,
            'status' => "Dalam Proses",
            'keterangan' => 'Pengaduan Anda sedang dalam proses peninjauan atau penanganan oleh pihak instansi. Kami akan menginformasikan kembali setelah proses selesai.'
        ];
        $this->Mhistori->save($datahistori);
        session()->setFlashdata('pesansimpan', 'Berhasil Diproses');
        return redirect()->back()->withInput();
    }
    public function proses_selesai($id_pengaduan)
    {
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,application/zip]|max_size[file,2120]',
                'errors' => [
                    'uploaded' => 'File tidak ditemukan atau tidak di-upload dengan benar.',
                    'mime_in' => 'Hanya file dengan ekstensi .pdf, .docx, .doc, .txt, atau .odt yang diizinkan.',
                    'max_size' => 'Ukuran file maksimal 2MB.'
                ]
            ]
        ])) {
            session()->setFlashdata('errorfile', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $Berkasfoto = $this->request->getFile('file');
        // jika form foto kosong
        if ($Berkasfoto->getError() == 4) {
            $file = 'FILE KOSONG.pdf';
        } else {
            $file = $Berkasfoto->getRandomName();
            $Berkasfoto->move('bukti_pengaduan/', $file);
        }

        $email_tujuan = $this->request->getVar('email');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $email->setMessage('Pengaduan Anda telah selesai diproses oleh pihak instansi. Terima kasih telah berpartisipasi dalam membangun lingkungan yang lebih baik.');
        $email->send();
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'bukti' => $file,
            'status' => 'Selesai'
        ];
        $this->Mpengaduan->save($data);

        $datahistori = [
            'id_pengaduan' => $id_pengaduan,
            'status' => "Selesai",
            'keterangan' => 'Pengaduan Anda telah selesai diproses oleh pihak instansi. Terima kasih telah berpartisipasi dalam membangun lingkungan yang lebih baik.'
        ];
        $this->Mhistori->save($datahistori);
        session()->setFlashdata('pesansimpan', 'Berhasil');
        return redirect()->back()->withInput();
    }
    public function proses_tolak($id_pengaduan)
    {
        $email_tujuan = $this->request->getVar('email');
        $pesan = $this->request->getVar('tolak');
        $email = service('email');
        $email->setTo($email_tujuan);
        $email->setFrom('admin@bonebolango.com', 'Admin');
        $email->setSubject('Pesan Admin');
        $email->setMessage('Mohon maaf, pengaduan Anda tidak dapat diproses lebih lanjut karena ' . $pesan . ' Anda dapat mengajukan kembali dengan memperbarui informasi yang diperlukan.');
        $email->send();
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'status' => 'Ditolak'
        ];
        $this->Mpengaduan->save($data);

        $datahistori = [
            'id_pengaduan' => $id_pengaduan,
            'status' => "Ditolak",
            'keterangan' => 'Mohon maaf, pengaduan Anda tidak dapat diproses lebih lanjut karena ' . $pesan . ' Anda dapat mengajukan kembali dengan memperbarui informasi yang diperlukan.'
        ];
        $this->Mhistori->save($datahistori);
        session()->setFlashdata('pesansimpan', 'Berhasil Ditolak');
        return redirect()->back()->withInput();
    }

    public function viewlaporan()

    {
        $instansi_id = session()->get('instansi_id');
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $allpengaduan = $this->Mpengaduan->semuaPengaduan();
        $allpengaduanOP = $this->Mpengaduan->semuaPengaduanOP($instansi_id);
        $data = [
            'title' => 'Laporan Pengaduan',
            'pengaduan_perstatus' => $pengaduan_perstatus,
            'pengaduan' => $allpengaduan,
            'pengaduanOP' => $allpengaduanOP

        ];
        return view('admin_pages/v_pengaduan_laporan', $data);
    }
    public function viewfilter()

    {
        $instansi_id = session()->get('instansi_id');
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $allpengaduan = $this->Mpengaduan->semuaPengaduan();
        $allpengaduanOP = $this->Mpengaduan->semuaPengaduanOP($instansi_id);
        $data = [
            'title' => 'Filter Pengaduan',
            'pengaduan_perstatus' => $pengaduan_perstatus,
            'pengaduan' => $allpengaduan,
            'pengaduanOP' => $allpengaduanOP,

        ];
        return view('admin_pages/v_pengaduan_laporan_filter', $data);
    }
}
