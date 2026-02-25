<?php

namespace App\Controllers;

use App\Models\Mkategori;
use App\Models\Mdeskripsi;
use App\Models\Mpengaduan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    protected $Mkategori;
    protected $Mdeskripsi;
    protected $Mpengaduan;

    public function __construct()
    {
        $this->Mkategori = new Mkategori();
        $this->Mdeskripsi = new Mdeskripsi();
        $this->Mpengaduan = new Mpengaduan();
    }
    public function index()
    {
        $pengaduan_perstatus = $this->Mpengaduan->getPengaduanByDetailStatus();

        $data = [
            'title' => 'Kategori',
            'kategori' => $this->Mkategori->findAll(),
            'deskripsi' => $this->Mdeskripsi->getkategori(),
            'pengaduan_perstatus' => $pengaduan_perstatus,

        ];
        return view('admin_pages/v_kategori', $data);
    }
    public function proses()
    {
        $nama_kategori = $this->request->getVar('nama_kategori');
        $this->Mkategori->save([
            'nama_kategori' => $nama_kategori
        ]);

        session()->setFlashdata('pesansimpan', 'Berhasil Disimpan');
        return redirect()->to('admin/kategori');
    }
    public function proses_ubah($id_kategori)
    {
        $nama_kategori = $this->request->getVar('nama_kategori');
        $this->Mkategori->save([
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori
        ]);
        session()->setFlashdata('pesansimpan', 'Berhasil Diubah');
        return redirect()->to('admin/kategori');
    }
    public function hapus($id)
    {

        if ($this->Mkategori->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
    public function proses_deskripsi()
    {
        $id_kategori = $this->request->getVar('id_kategori');
        $isi_deskripsi = $this->request->getVar('isi_deskripsi');
        $this->Mdeskripsi->save([
            'id_kategori' => $id_kategori,
            'isi_deskripsi' => $isi_deskripsi
        ]);
        session()->setFlashdata('pesansimpan', 'Berhasil Disimpan');
        return redirect()->to('admin/kategori');
    }
    public function proses_ubah_deskripsi($id_deskripsi)
    {
        $id_kategori = $this->request->getVar('id_kategori');
        $isi_deskripsi = $this->request->getVar('isi_deskripsi');
        $this->Mdeskripsi->save([
            'id_deskripsi' => $id_deskripsi,
            'id_kategori' => $id_kategori,
            'isi_deskripsi' => $isi_deskripsi
        ]);
        session()->setFlashdata('pesansimpan', 'Berhasil Diubah');
        return redirect()->to('admin/kategori');
    }
    public function hapus_deskripsi($id)
    {

        if ($this->Mdeskripsi->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
