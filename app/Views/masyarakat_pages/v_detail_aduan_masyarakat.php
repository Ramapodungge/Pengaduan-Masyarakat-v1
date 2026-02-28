<?= $this->extend('masyarakat_pages/template/template_masyarakat'); ?>
<?= $this->section('content-home'); ?>

<?php
function formatTanggalIndonesiaWITA($datetime)
{
    // Set zona waktu ke WITA (Asia/Makassar)
    date_default_timezone_set('Asia/Makassar');

    // Array bulan dalam bahasa Indonesia
    $bulanIndo = [
        1 => 'Januari',
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
    ];

    // Ubah string datetime menjadi objek DateTime
    $tanggal = new DateTime($datetime);

    // Format ke bentuk tanggal Indonesia
    $hari = $tanggal->format('d'); // Hari
    $bulan = $bulanIndo[(int)$tanggal->format('m')]; // Bulan dalam bahasa Indonesia
    $tahun = $tanggal->format('Y'); // Tahun
    $jam = $tanggal->format('H:i:s'); // Jam dengan detik

    return "$hari $bulan $tahun $jam WITA";
}
?>
<main class="main position-relative">
    <div class="detail-header-background">
        <img src="./assets-home/assets/detail-header-image-2560x330.png" alt="" />
    </div>
    <!-- /.detail-background -->

    <div class="container-xxl">
        <div class="position-relative py-43 py-lg-80">
            <div class="d-grid gap-10 text-center">
                <h4 class="heading-section-4 text-white mb-0">Detail Aduan</h4>
                <div class="heading-text-2 text-white">Informasi lengkap mengenai aduan yang telah diajukan dan
                    perkembangannya.</div>
            </div>
            <!-- /.heading-header -->
            <?php if (session()->has('logged_in_mas') and session()->get('logged_in_mas') == true) : ?>
                <a class="position-absolute btn btn-rounded btn-white top-0 top-md-50 top-md start-0 translate-middle-md-y p-10 mt-15 mt-md-0"
                    href="/masyarakat/profile">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <!-- /.btn-back -->
            <?php endif ?>
        </div>
    </div>
    <!-- /.container -->
    <!-- = /. Header Section = -->

    <div class="container-xxl">
        <div class="row">
            <?php foreach ($pengaduan as $adu): ?>
                <div class="col-12 col-lg-12 col-xl-8">
                    <div class="d-grid d-xl-flex bg-white p-20 p-md-34 p-xxl-43 gap-34 rounded-20 shadow-2">
                        <div class="d-flex align-items-center">
                            <div class="d-grid">
                                <h2 class="heading-section-4 text-dark mb-2"><?= $adu['judul'] ?></h2>
                                <div class="d-flex flex-column flex-xl-row gap-15 gap-xl-34 py-10 py-lg-20">
                                    <div class="info-card">
                                        <div class="info-card-icon bg-ufo-green-100 rounded-pill">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <div class="info-card-content flex-nofill">
                                            <h6 class="info-card-title">Tanggal Aduan</h6>
                                            <div class="info-card-desc"><?= formatTanggalIndonesiaWITA($adu['created_at']) ?></div>
                                        </div>
                                    </div>
                                    <!-- /.info-card-component -->

                                    <div class="info-card">
                                        <div class="info-card-icon bg-deep-lilac rounded-pill">
                                            <i class="fas fa-location"></i>
                                        </div>
                                        <div class="info-card-content flex-nofill">
                                            <h6 class="info-card-title">Tujuan</h6>
                                            <div class="info-card-desc"><?= $adu['nama_instansi'] ?></div>
                                        </div>
                                    </div>
                                    <!-- /.info-card-component -->

                                    <div class="info-card">
                                        <div class="info-card-icon bg-rajah rounded-pill">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="info-card-content flex-nofill">
                                            <h6 class="info-card-title">Status</h6>
                                            <div class="info-card-desc"><?= $adu['status'] ?></div>
                                        </div>
                                    </div>
                                    <!-- /.info-card-component -->
                                </div>

                                <div class="d-grid mt-20">
                                    <div class="fs-14 fw-semiBold">Isi Laporan</div>
                                    <div class="fs-16">
                                        <p>
                                            <?= $adu['isi'] ?>
                                        </p>
                                        <img src="foto_laporan/<?= $adu['foto'] ?>" width="50%" alt="" id="myImage" style="cursor: pointer;" onclick="showFullImage()">
                                        <img src="foto_laporan/<?= $adu['foto'] ?>" alt="" id="fullImage" style="display:none; width: 100%; height: 100vh; cursor:pointer;" onclick="showThumbnail()">
                                    </div>
                                </div>
                            </div>
                            <!-- /.job-title and job-meta -->
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="col-12 col-lg-12 col-xl-4">
                <?php if (isset($pengaduanStatus['status']) && $pengaduanStatus['status'] == 'Selesai') : ?>
                    <?php if (session()->has('logged_in_mas') and session()->get('logged_in_mas') == true) :
                        if (session()->get('nik') == $pengaduanStatus['id_masyarakat']):
                    ?>
                            <div class="bg-white p-20 p-md-34 p-xxl-43 rounded-20 shadow-2">
                                <h2 class="heading-section-4 text-dark mb-0 mb-3">Feedback</h2>
                                <?php if ($cek_row == 1) :
                                    foreach ($feedback as $feed) :
                                        echo $feed['feedback'];

                                ?>
                                        <div class="mt-5">
                                            <button type="button" class="btn btn-primary col-4 rounded-20" id="feedbackButton"> Edit Pesan</button>
                                        </div>
                                        <div id="feedbackForm" style="display:none;">
                                            <form action="/masyarakat/proses_edit_feedback/<?= $feed['id_feedback']; ?>" method="post" class="row">
                                                <?= csrf_field() ?>
                                                <div class="col-12 mt-5">
                                                    <label for="textareaAboutyou" class="form-label">Masukan Feedback</label>
                                                    <input type="hidden" value="<?= $id_pengaduan ?>" name="id_pengaduan">
                                                    <textarea name="feed" class="form-control" id="textareaAboutyou" rows="5"
                                                        placeholder="Type here" required></textarea>
                                                </div>
                                                <div class="mt-5">
                                                    <button type="submit" class="btn btn-primary col-6 rounded-20"> Simpan</button>
                                                    <button type="button" class="btn bg-mikado-yellow text-white col-4 rounded-20" id="closeButton"> Tutup</button>

                                                </div>
                                            </form>
                                        </div>
                                <?php
                                    endforeach;
                                endif ?>
                                <?php if ($cek_row == 0) :

                                ?>


                                    <form action="/masyarakat/proses_feedback" method="post" class="row">
                                        <?= csrf_field() ?>
                                        <div class="col-12">
                                            <label for="textareaAboutyou" class="form-label">Masukan Feedback</label>
                                            <input type="hidden" value="<?= $id_pengaduan ?>" name="id_pengaduan">
                                            <textarea name="feed" class="form-control" id="textareaAboutyou" rows="5"
                                                placeholder="Type here" required></textarea>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-primary col-6 rounded-20"> Simpan</button>
                                        </div>
                                    </form>
                                <?php
                                endif ?>
                            </div>
                    <?php
                        endif;
                    endif ?>
                <?php
                endif ?>

                <div class="d-grid d-xl-flex bg-white p-20 p-md-34 p-xxl-43 gap-34 mt-20 rounded-20 shadow-2">
                    <div class="d-flex align-items-center">
                        <div class="d-grid gap-10">
                            <h2 class="heading-section-4 text-dark mb-15">Timeline Aduan</h2>
                            <div class="timeline-wrapper">
                                <?php foreach ($timline as $time): ?>
                                    <!-- Menunggu Verifikasi -->
                                    <div class="timeline-item">
                                        <?php if ($time['status'] == "Diajukan") : ?>
                                            <div class="timeline-marker bg-majorelle-blue-200"></div>
                                        <?php endif ?>
                                        <?php if ($time['status'] == "Terverifikasi") : ?>
                                            <div class="timeline-marker bg-ufo-green-100"></div>

                                        <?php endif ?>
                                        <?php if ($time['status'] == "Dialokasi") : ?>
                                            <div class="timeline-marker bg-pumpkin"></div>

                                        <?php endif ?>
                                        <?php if ($time['status'] == "Dalam Proses") : ?>
                                            <div class="timeline-marker bg-mikado-yellow"></div>
                                        <?php endif ?>
                                        <?php if ($time['status'] == "Selesai") : ?>
                                            <div class="timeline-marker bg-lime-green"></div>
                                        <?php endif ?>
                                        <?php if ($time['status'] == "Ditolak") : ?>
                                            <div class="timeline-marker bg-orange-red"></div>
                                        <?php endif ?>
                                        <div class="timeline-content">
                                            <?php if ($time['status'] == "Diajukan") : ?>

                                                <div class="timeline-header">
                                                    <span class="timeline-status bg-majorelle-blue-200 text-white">Menunggu
                                                        Verifikasi</span>
                                                    <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att'])  ?></span>
                                                </div>
                                                <p class="fs-14"><?= $time['keterangan'] ?></p>
                                            <?php endif ?>
                                            <?php if ($time['status'] == "Terverifikasi") : ?>

                                                <div class="timeline-header">
                                                    <span class="timeline-status bg-ufo-green-100 text-white">Pengaduan
                                                        Terverifikasi</span>
                                                    <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att']) ?></span>
                                                </div>
                                                <p class="fs-14"><?= $time['keterangan'] ?>
                                                </p>
                                            <?php endif ?>
                                            <?php if ($time['status'] == "Dialokasi") : ?>
                                                <div class="timeline-header">
                                                    <span class="timeline-status bg-pumpkin text-white">Pengaduan
                                                        Dialokasikan</span>
                                                    <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att']) ?></span>
                                                </div>
                                                <p class="fs-14"><?= $time['keterangan'] ?>
                                                </p>
                                            <?php endif ?>
                                            <?php if ($time['status'] == "Dalam Proses") : ?>
                                                <div class="timeline-header">
                                                    <span class="timeline-status bg-mikado-yellow text-white">Dalam
                                                        Proses</span>
                                                    <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att']) ?></span>
                                                </div>
                                                <p class="fs-14"><?= $time['keterangan'] ?></p>
                                            <?php endif ?>
                                            <?php if ($time['status'] == "Selesai") : ?>
                                                <div class="timeline-header">
                                                    <span class="timeline-status bg-lime-green text-white">Selesai</span>
                                                    <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att']) ?></span>
                                                </div>
                                                <p class="fs-14"><?= $time['keterangan'] ?></p>
                                                <span>File Bukti: <a href="/masyarakat/download_bukti/<?= $time['bukti'] ?>"><?= $time['bukti'] ?></a></span>
                                            <?php endif ?>
                                            <?php if ($time['status'] == "Ditolak") : ?>
                                                <div class="timeline-header">
                                                    <div class="timeline-header">
                                                        <span class="timeline-status bg-orange-red text-white">Ditolak</span>
                                                        <span class="timeline-date"><?= formatTanggalIndonesiaWITA($time['created_att']) ?></span>
                                                    </div>
                                                    <p class="fs-14"><?= $time['keterangan'] ?>
                                                    </p>
                                                <?php endif ?>
                                                </div>

                                        </div>
                                    <?php endforeach ?>
                                    </div>

                            </div>
                            <!-- /.job-title and job-meta -->
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- = /. Main Section = -->

    <div class="mt-xl-43"></div>
    <!-- = /. Gap Section = -->

</main>
<!-- = /. Main Section = -->
<?= $this->endSection(); ?>