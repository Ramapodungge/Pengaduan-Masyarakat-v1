<?php

namespace App\Controllers;

use App\Models\Minstansi;
use App\Models\Mpengaduan;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Instansi extends BaseController
{
    protected $Minstansi;
    protected $Mpengaduan;
    public function __construct()
    {
        $this->Minstansi = new Minstansi();
        $this->Mpengaduan = new Mpengaduan();
    }
    public function index()
    {
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();
        $instansi = $this->Minstansi->findAll();
        $data = [
            'title' => 'Instansi',
            'instansi' => $instansi,
            'pengaduan_perstatus' => $pengaduan_perstatus,

        ];
        return view('admin_pages/v_instansi', $data);
    }
    public function proses()
    {
        $nama_instansi = $this->request->getVar('nama_instansi');
        $this->Minstansi->save([
            'nama_instansi' => $nama_instansi
        ]);
        session()->setFlashdata('pesansimpan', 'Berhasil Disimpan');
        return redirect()->to('admin/instansi');
    }
    public function proses_ubah($id_instansi)
    {
        $nama_instansi = $this->request->getVar('nama_instansi');
        $this->Minstansi->save([
            'id_instansi' => $id_instansi,
            'nama_instansi' => $nama_instansi
        ]);
        session()->setFlashdata('pesansimpan', 'Berhasil Diubah');
        return redirect()->to('admin/instansi');
    }
    public function hapus($id)
    {

        if ($this->Minstansi->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
