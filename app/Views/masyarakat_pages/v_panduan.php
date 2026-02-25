<?= $this->extend('masyarakat_pages/template/template_masyarakat'); ?>
<?= $this->section('content-home'); ?>

<?php
function merubah_tanggal($tgl)
{
    $bulan = array(
        1 => 'januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tgl);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

?>
<main class="main position-relative">
    <div class="detail-header-background">
        <img src="./assets-home/assets/detail-header-image-2560x330.png" alt="" />
    </div>

    <div class="container-xxl">
        <div class="position-relative py-5 py-lg-100">
            <div class="d-grid gap-10 text-center">
                <h4 class="heading-section-4 text-white mb-0">Ruang Suara</h4>
                <div class="heading-text-2 text-white">
                    <p class="text-white text-decoration-none" href="#">
                        Menyampaikan keluhan kini lebih mudah!
                        Aplikasi Pengaduan Masyarakat Kabila Bone hadir untuk mempercepat penanganan laporan, meningkatkan transparansi, dan mewujudkan pelayanan publik yang lebih responsif.

                    </p>
                </div>
            </div>
            <!-- /.heading-header -->

            <!-- /.btn-book-mobile -->
        </div>
    </div>
    <div class="container-xxl mt-lg-100 mb-100">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h3 class="d-sm-none" style="margin-top: 40px;">Panduan</h3>
                <h3 class="d-md-block d-none">Panduan</h3>
                <p style="text-align: justify;"> memberikan petunjuk langkah demi langkah kepada masyarakat agar dapat menggunakan aplikasi pengaduan dengan benar, cepat, dan tanpa kebingungan.
                    Dengan adanya halaman ini, pengguna (terutama masyarakat umum) bisa memahami alur penggunaan sistem tanpa perlu bantuan admin.</p>

                <h3>Langkah-Langkah Melakukan Pengaduan</h3>
                <div class="mt-20">
                    <!-- Langkah 1 -->
                    <div class="p-4 step-card">
                        <h5 class="fw-bold">1. Membuat Akun</h5>
                        <p>Masuk ke halaman pendaftaran, isi data sesuai form (NIK, Nama, Username, Password, dsb), lalu klik <strong>Daftar</strong>.</p>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="p-4 step-card">
                        <h5 class="fw-bold">2. Login ke Sistem</h5>
                        <p>Setelah terdaftar, buka halaman login, masukkan username dan password yang telah kamu buat sebelumnya.</p>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="p-4 step-card">
                        <h5 class="fw-bold">3. Mengisi Form Pengaduan</h5>
                        <p>Pilih menu <strong>Buat Pengaduan</strong>, isi detail laporan dengan lengkap, dan klik <strong>Kirim</strong>.</p>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="p-4 step-card">
                        <h5 class="fw-bold">4. Melihat Status Pengaduan</h5>
                        <p>Kamu dapat memantau status laporan melalui menu <strong>Riwayat Pengaduan</strong> di dashboard.</p>
                    </div>

                    <!-- Langkah 5 -->
                    <div class="p-4 step-card">
                        <h5 class="fw-bold">5. Unduh Bukti atau Laporan</h5>
                        <p>Setelah laporan selesai diproses, kamu dapat mengunduh hasilnya dalam format PDF melalui tombol <strong>Unduh</strong>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <h3 class="mb-3">Links</h3>
                <div class="card shadow-sm p-3" style="border-radius: 12px;">
                    <nav class="nav flex-column">
                        <a class="nav-link text-dark d-flex align-items-center mb-2" href="/">
                            🏠 <span class="ms-2"> Home</span>
                        </a>
                        <a class="nav-link text-dark d-flex align-items-center mb-2" href="buataduan">
                            📋 <span class="ms-2">Pengaduan</span>
                        </a>
                        <a class="nav-link text-dark d-flex align-items-center" href="masuk_admin">
                            🔐 <span class="ms-2">Login</span>
                        </a>
                    </nav>
                </div>
                <div style="margin-top: 20px;">

                    <h3>Download</h3>
                    <a href="panduanfile">
                        📁 panduan.pdf
                    </a>
                </div>
                <div style="margin-top: 20px;">
                    <h3>Kontak</h3>
                    <span>
                        <i class="fa-solid fa-envelope"></i> Email
                        <br>kabila.bone@gmail.com
                    </span><br>
                    <span>
                        <i class="fa-solid fa-phone-volume"></i> Watshapp
                        <br>(+62) 89767667667

                    </span>
                </div>
            </div>

        </div>
    </div>
</main>
<!-- Modals -->

<!-- Modals -->

<?= $this->endSection(); ?>