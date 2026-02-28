<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpengaduan extends Model
{
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id_pengaduan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_masyarakat', 'id_instansi', 'id_kategori', 'judul', 'isi', 'foto', 'status', 'created_at', 'updated_at', 'bukti', 'tipe_aduan'];

    public function getLastID()
    {
        return $this->db->insertID();
    }

    public function getAll($id_aduan)
    {
        $builder = $this->db->table('pengaduan');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.id_pengaduan', $id_aduan);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function semuaPengaduan()
    {
        $builder = $this->db->table('pengaduan');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function semuaPengaduanOP($instansi_id)
    {
        $builder = $this->db->table('pengaduan');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.id_instansi', $instansi_id);
        $builder->orderBy('pengaduan.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function formulirGet($id_pengaduan)
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.id_pengaduan', $id_pengaduan);
        $builder->orderBy('pengaduan.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanDiajukan()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Diajukan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanTerverifikasi()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Terverifikasi');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanDialokasi()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Dialokasi');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanDalamProses()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Dalam Proses');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanSelesai()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Selesai');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanDitolak()
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Ditolak');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // MODEL KHUSU DAFTAR ADUAN OPERATOR
    public function getAduanDialokasiOP($get_id)
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Dialokasi');
        $builder->where('pengaduan.id_instansi', $get_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAduanDalamProsesOP($get_id)
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Dalam Proses');
        $builder->where('pengaduan.id_instansi', $get_id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAduanSelesaiOP($get_id)
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('pengaduan.*, masyarakat.nik, masyarakat.nama_pengadu, kategori_pengaduan.nama_kategori, instansi.nama_instansi');
        $builder->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat');
        $builder->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori');
        $builder->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi');
        $builder->where('pengaduan.status', 'Selesai');
        $builder->where('pengaduan.id_instansi', $get_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // BATAS MODE KHUSUS ADUAN OPERATOR

    // Fungsi untuk mengambil data dengan pagination khusus Publik
    public function getPengaduanPublik($limit)
    {
        // Menjalankan query join untuk mendapatkan data terkait
        return $this->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, instansi.nama_instansi as nama_instansi, kategori_pengaduan.nama_kategori as nama_kategori')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->whereIn('pengaduan.tipe_aduan', ['Umum', 'Anonim']) // ✅ Filter tipe aduan
            ->orderBy('pengaduan.created_at', 'DESC')
            ->paginate($limit); // Pagination
    }
    // Fungsi untuk mengambil data dengan pagination
    public function getPengaduan($limit, $nik)
    {
        // Menjalankan query join untuk mendapatkan data terkait
        return $this->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, instansi.nama_instansi as nama_instansi, kategori_pengaduan.nama_kategori as nama_kategori')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->where('pengaduan.id_masyarakat', $nik)
            ->orderBy('pengaduan.created_at', 'DESC')
            ->paginate($limit); // Pagination
    }

    // Menghitung total data untuk pagination
    public function countPengaduan()
    {
        return $this->countAllResults();
    }

    // Mendapatkan jumlah pengaduan
    public function getTotalPengaduan()
    {
        return $this->countAllResults();
    }
    public function getTotalPengaduanOP($id_instansi)
    {
        return $this->where('id_instansi', $id_instansi)->countAllResults();
    }

    // Mendapatkan pengaduan terbaru
    public function getPengaduanTerbaru()
    {
        return $this->db->table('pengaduan')
            ->where('status', 'Diajukan')
            ->where('DATE(created_at) >=', date('Y-m-d', strtotime('-3 days')))
            ->countAllResults();
    }
    public function getPengaduanTerbaruOP($id_instansi)
    {
        return $this->where('status', 'Dialokasi')->where('id_instansi', $id_instansi)
            ->orderBy('updated_at', 'DESC')->countAllResults();
    }
    // Mendapatkan pengaduan berdasarkan masyarakat
    public function getPengaduanByMasyarakat()
    {
        $builder = $this->builder();
        $builder->select('masyarakat.nama_pengadu, COUNT(*) as jumlah_pengaduan')
            ->join('masyarakat', 'pengaduan.id_masyarakat = masyarakat.nik')
            ->groupBy('masyarakat.nama_pengadu');
        return $builder->get()->getResultArray();
    }
    public function getPengaduanByMasyarakatOP($id_instansi)
    {
        $builder = $this->builder();
        $builder->select('pengaduan.status, masyarakat.nama_pengadu, COUNT(*) as jumlah_pengaduan')
            ->join('masyarakat', 'pengaduan.id_masyarakat = masyarakat.nik')
            ->groupBy('masyarakat.nama_pengadu')->where('id_instansi', $id_instansi);
        return $builder->get()->getResultArray();
    }
    public function getPengaduanBykategori()
    {
        return $this->select('kategori_pengaduan.nama_kategori, COUNT(pengaduan.id_pengaduan) AS jumlah_pengaduan')
            ->join('kategori_pengaduan', 'pengaduan.id_kategori = kategori_pengaduan.id_kategori')
            ->groupBy('kategori_pengaduan.nama_kategori')
            ->findAll();
    }
    public function getPengaduanBykategoriOP($id_instansi)
    {
        return $this->select('kategori_pengaduan.nama_kategori, COUNT(pengaduan.id_pengaduan) AS jumlah_pengaduan')
            ->join('kategori_pengaduan', 'pengaduan.id_kategori = kategori_pengaduan.id_kategori')
            ->groupBy('kategori_pengaduan.nama_kategori')
            ->where('id_instansi', $id_instansi)
            ->findAll();
    }
    public function getPengaduanByDetailStatus()
    {
        $builder = $this->builder();
        $builder->select('status, COUNT(*) as jumlah')
            ->groupBy('status');
        return $builder->get()->getResult();
    }

    public function searchPengaduan($limit, $page, $search = '', $instansi_id = null, $kategori_id = null)
    {
        // Menghitung offset berdasarkan halaman
        $offset = ($page - 1) * $limit;

        // Membuat query builder untuk mengambil data pengaduan
        $builder = $this->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, instansi.nama_instansi as nama_instansi, kategori_pengaduan.nama_kategori as nama_kategori')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->where('pengaduan.tipe_aduan', 'Umum');  // Filter untuk tipe aduan "Umum"

        // Jika ada pencarian berdasarkan judul
        if ($search) {
            $builder->like('pengaduan.judul', $search);  // Pencarian berdasarkan judul
        }

        // Filter Instansi jika user memilih value angka/ID
        if (!empty($instansi_id) && is_numeric($instansi_id)) {
            $builder->where('pengaduan.id_instansi', $instansi_id);
        }

        // Filter Kategori
        if (!empty($kategori_id) && is_numeric($kategori_id)) {
            $builder->where('pengaduan.id_kategori', $kategori_id);
        }

        // Menambahkan pagination
        return $builder->limit($limit, $offset)->get()->getResultArray();
    }
    public function countPengaduann($search = '', $instansi_id = null, $kategori_id = null)
    {
        // Membuat query builder untuk menghitung jumlah data pengaduan
        $builder = $this->table('pengaduan')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->where('pengaduan.tipe_aduan', 'Umum');  // Filter untuk tipe aduan "Umum"

        // Jika ada pencarian berdasarkan judul
        if ($search) {
            $builder->like('pengaduan.judul', $search);  // Pencarian berdasarkan judul
        }

        if (!empty($instansi_id) && is_numeric($instansi_id)) {
            $builder->where('pengaduan.id_instansi', $instansi_id);
        }

        if (!empty($kategori_id) && is_numeric($kategori_id)) {
            $builder->where('pengaduan.id_kategori', $kategori_id);
        }
        // Menghitung jumlah total data pengaduan yang sesuai dengan kriteria pencarian
        return $builder->countAllResults();
    }


    // 🔥 Fungsi untuk filter berdasarkan bulan dan tahun
    public function getAllWithJoins()
    {
        return $this->db->table($this->table)
            ->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, kategori_pengaduan.nama_kategori as nama_kategori, instansi.nama_instansi as nama_instansi')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->orderBy('pengaduan.created_at', 'DESC')
            ->get()->getResultArray();
    }
    // Fungsi filter yang aman terhadap input kosong/tipe string
    public function filterByMonthYear($bulan = null, $tahun = null)
    {
        $builder = $this->db->table($this->table)
            ->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, kategori_pengaduan.nama_kategori as nama_kategori, instansi.nama_instansi as nama_instansi')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left');

        // Normalisasi input: kosong -> null, else cast to int
        if ($bulan !== null && $bulan !== '') {
            // accept '01'..'12' or '1'..'12'
            $bulanInt = (int) $bulan;
            if ($bulanInt >= 1 && $bulanInt <= 12) {
                $builder->where('MONTH(pengaduan.created_at)', $bulanInt);
            } else {
                // invalid month -> force no results (optional) or ignore
                $builder->where('1', '0'); // akan menghasilkan empty set
            }
        }

        if ($tahun !== null && $tahun !== '') {
            // cast to int and basic sanity check
            $tahunInt = (int) $tahun;
            if ($tahunInt > 1970 && $tahunInt <= (int)date('Y') + 1) {
                $builder->where('YEAR(pengaduan.created_at)', $tahunInt);
            } else {
                // invalid year -> force no results
                $builder->where('1', '0');
            }
        }

        return $builder->orderBy('pengaduan.created_at', 'DESC')->get()->getResultArray();
    }
    public function filterByMonthYearOP($bulan = null, $tahun = null, $instansi_id)
    {
        $builder = $this->db->table($this->table)
            ->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, kategori_pengaduan.nama_kategori as nama_kategori, instansi.nama_instansi as nama_instansi, instansi.id_instansi')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->where('pengaduan.id_instansi', $instansi_id);

        // Normalisasi input: kosong -> null, else cast to int
        if ($bulan !== null && $bulan !== '') {
            // accept '01'..'12' or '1'..'12'
            $bulanInt = (int) $bulan;
            if ($bulanInt >= 1 && $bulanInt <= 12) {
                $builder->where('MONTH(pengaduan.created_at)', $bulanInt);
            } else {
                // invalid month -> force no results (optional) or ignore
                $builder->where('1', '0'); // akan menghasilkan empty set
            }
        }

        if ($tahun !== null && $tahun !== '') {
            // cast to int and basic sanity check
            $tahunInt = (int) $tahun;
            if ($tahunInt > 1970 && $tahunInt <= (int)date('Y') + 1) {
                $builder->where('YEAR(pengaduan.created_at)', $tahunInt);
            } else {
                // invalid year -> force no results
                $builder->where('1', '0');
            }
        }

        return $builder->orderBy('pengaduan.created_at', 'DESC')->get()->getResultArray();
    }


    // Filter berdasarkan bulan
    public function filterByMonth($bulan)
    {
        return $this->db->table($this->table)
            ->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, kategori_pengaduan.nama_kategori as nama_kategori, instansi.nama_instansi as nama_instansi')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->where('MONTH(pengaduan.created_at)', $bulan)
            ->orderBy('pengaduan.created_at', 'DESC')
            ->get()->getResultArray();
    }

    // Filter berdasarkan tahun
    public function filterByYear($tahun)
    {
        return $this->db->table($this->table)
            ->select('pengaduan.*, masyarakat.nama_pengadu as nama_masyarakat, kategori_pengaduan.nama_kategori as nama_kategori, instansi.nama_instansi as nama_instansi')
            ->join('masyarakat', 'masyarakat.nik = pengaduan.id_masyarakat', 'left')
            ->join('kategori_pengaduan', 'kategori_pengaduan.id_kategori = pengaduan.id_kategori', 'left')
            ->join('instansi', 'instansi.id_instansi = pengaduan.id_instansi', 'left')
            ->where('YEAR(pengaduan.created_at)', $tahun)
            ->orderBy('pengaduan.created_at', 'DESC')
            ->get()->getResultArray();
    }
}
