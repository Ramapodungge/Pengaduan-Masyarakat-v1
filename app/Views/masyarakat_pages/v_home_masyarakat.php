<?= $this->extend('masyarakat_pages/template/template_masyarakat'); ?>
<?= $this->section('content-home'); ?>
<main class="main">
    <div class="bg-ghost-white">
        <div class="container-xxl">
            <div class="row">
                <div
                    class="col-12 col-lg-6 col-xl-5 d-flex align-items-center my-34 my-lg-60 my-xl-120 order-2 order-lg-1">
                    <div class="swiper header-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h1 class="heading-header-1 mb-0">
                                    Laporkan Dengan
                                    <span class="text-primary">Mudah,</span> Dapatkan Solusi
                                    Lebih <span class="text-primary">Cepat</span>
                                </h1>
                                <div class="heading-text-2">
                                    Temukan cara baru menyampaikan aspirasi, keluhan, dan
                                    saran untuk pelayanan publik di Kecamatan Kabila.
                                </div>
                            </div>
                        </div>
                        <!-- /.header-slider-content -->

                        <div class="d-flex flex-wrap align-items-center mt-60 gap-20">
                            <a
                                class="btn btn-primary fw-semiBold py-12 px-34 rounded-pill"
                                href="/masyarakat/buataduan"
                                role="button"><i class="fas fa-pencil"></i> Ajukan Aduan Sekarang</a>
                            <a
                                class="btn btn-cultured fw-semiBold py-12 px-34 rounded-pill"
                                href="panduanfile"
                                role="button"><i class="fas fa-file"></i> Lihat Panduan</a>
                        </div>
                        <!-- /.btn-discover-now and watch-video -->

                        <div
                            class="pagination-slider pagination-line header-slider-pagination mt-60"></div>
                        <!-- /.header-slider-pagination -->
                    </div>
                    <!-- /.header-slider -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-lg-6 col-xl-7 order-1 order-lg-2">
                    <div class="position-relative h-lg-100">
                        <img
                            src="./assets-home/assets/pages/index/header/heroImage.png"
                            class="hero-image-img"
                            alt="" />
                        <!-- /. hero-image -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- = /. Header Section = -->

    <div class="mt-43"></div>
    <!-- = /. Gap Section = -->

    <div class="container-xxl py-60 overflow-hidden overflow-xxl-visible">
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-5 order-2 order-lg-1">
                <div class="d-grid gap-12 w-md-75 w-lg-100">
                    <div class="heading-text-1 text-primary">
                        Setiap Suara Punya Jalan Menuju Solusi
                    </div>
                    <h2 class="heading-section-1 text-dark mb-0">
                        Bagaimana Pengaduan Anda Diproses
                    </h2>
                </div>
                <!-- /.heading-section -->

                <div
                    class="accordion accordion-number mt-43"
                    id="accordion-how-it-works">
                    <div class="accordion-item">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                            <div class="position-relative d-flex w-100">
                                <div
                                    class="accordion-number bg-blue-violet bg-opacity-10 text-blue-violet">
                                    1
                                </div>
                                <div class="accordion-content">
                                    <h2 class="accordion-header" id="headingOne">
                                        Tulis Aduanmu
                                    </h2>
                                    <div
                                        id="collapseOne"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingOne"
                                        data-bs-parent="#accordion-how-it-works">
                                        <div class="accordion-body">
                                            Ceritakan masalah yang kamu alami secara singkat dan
                                            jelas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-arrow">
                                <img
                                    src="./assets-home/assets/icons/chevron-down.svg"
                                    class="svg-inject svg-icon"
                                    alt="" />
                            </div>
                        </button>
                    </div>
                    <!-- /.accordion-item -->

                    <div class="accordion-item">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo"
                            aria-expanded="true"
                            aria-controls="collapseTwo">
                            <div class="position-relative d-flex w-100">
                                <div
                                    class="accordion-number bg-persian-blue bg-opacity-10 text-persian-blue">
                                    2
                                </div>
                                <div class="accordion-content">
                                    <h2 class="accordion-header" id="headingTwo">
                                        Verifikasi & Tindak Lanjut
                                    </h2>
                                    <div
                                        id="collapseTwo"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo"
                                        data-bs-parent="#accordion-how-it-works">
                                        <div class="accordion-body">
                                            Setiap laporan ditangani oleh pihak berwenang secara
                                            profesional.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-arrow">
                                <img
                                    src="./assets-home/assets/icons/chevron-down.svg"
                                    class="svg-inject svg-icon"
                                    alt="" />
                            </div>
                        </button>
                    </div>
                    <!-- /.accordion-item -->

                    <div class="accordion-item">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseThree"
                            aria-expanded="true"
                            aria-controls="collapseThree">
                            <div class="position-relative d-flex w-100">
                                <div
                                    class="accordion-number bg-ufo-green bg-opacity-10 text-ufo-green">
                                    3
                                </div>
                                <div class="accordion-content">
                                    <h2 class="accordion-header" id="headingThree">
                                        Pantau Progres Secara Real-Time
                                    </h2>
                                    <div
                                        id="collapseThree"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingThree"
                                        data-bs-parent="#accordion-how-it-works">
                                        <div class="accordion-body">
                                            Kamu bisa melihat status aduanmu dari diterima,
                                            diproses, hingga selesai.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-arrow">
                                <img
                                    src="./assets-home/assets/icons/chevron-down.svg"
                                    class="svg-inject svg-icon"
                                    alt="" />
                            </div>
                        </button>
                    </div>
                    <!-- /.accordion-item -->

                    <div class="accordion-item">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsefour"
                            aria-expanded="true"
                            aria-controls="collapsefour">
                            <div class="position-relative d-flex w-100">
                                <div
                                    class="accordion-number bg-rajah bg-opacity-10 text-rajah">
                                    4
                                </div>
                                <div class="accordion-content">
                                    <h2 class="accordion-header" id="headingfour">
                                        Dapatkan Hasil & Umpan Balik
                                    </h2>
                                    <div
                                        id="collapsefour"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingfour"
                                        data-bs-parent="#accordion-how-it-works">
                                        <div class="accordion-body">
                                            Setelah selesai, kamu akan menerima notifikasi dan
                                            hasil penyelesaian.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-arrow">
                                <img
                                    src="./assets-home/assets/icons/chevron-down.svg"
                                    class="svg-inject svg-icon"
                                    alt="" />
                            </div>
                        </button>
                    </div>
                    <!-- /.accordion-item -->
                </div>
                <!-- /.accordion-number-component -->
            </div>
            <!-- /.col -->

            <div
                class="col-12 col-lg-6 offset-xxl-1 d-flex align-items-end mb-34 mb-lg-0 order-1 order-lg-2">
                <div class="position-relative">
                    <img
                        src="./assets-home/assets/how-it-work-image.png"
                        class="how-it-work-image-img rounded-40"
                        alt="" />
                    <img
                        src="./assets-home/assets/pages/index/how-it-work/figure-1.svg"
                        class="svg-inject position-absolute how-it-work-figure-1"
                        alt="" />
                    <img
                        src="./assets-home/assets/pages/index/how-it-work/figure-2.svg"
                        class="svg-inject position-absolute how-it-work-figure-2"
                        alt="" />
                    <img
                        src="./assets-home/assets/pages/index/how-it-work/figure-3.svg"
                        class="svg-inject position-absolute how-it-work-figure-3"
                        alt="" />
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- = /. How It Work Section = -->

    <div class="mt-xl-43"></div>
    <!-- = /. Gap Section = -->

    <div class="mt-xl-60"></div>
    <!-- = /. Gap Section = -->
    <div class="container-xxl">
        <div
            class="d-flex flex-column flex-xl-row align-items-xl-center gap-20"></div>
        <div class="row align-items-center">
            <div class="col-8">
                <h4 class="heading-section-4 text-dark mb-0">Daftar Aduan</h4>
            </div>
            <!-- /.col -->

            <div class="col-4 text-end">
                <span class="ms-auto">
                    <a
                        class="text-primary fw-semiBold text-decoration-none"
                        href="aduan_masyarakat">Lihat Semua</a>
                </span>
            </div>
            <!-- /.col -->
        </div>
        <div class="d-grid mt-60 gap-34">
            <?php foreach ($pengaduan as $adu):
            ?>
                <div class="job-card-harizontal">
                    <button
                        class="btn btn-rounded btn-white position-absolute d-xl-none top-100 start-50 p-10 translate-middle"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#jobInfoCardCollapse"
                        aria-expanded="false"
                        aria-controls="jobInfoCardCollapse">
                        <img
                            src="./assets-home/assets/icons/chevron-down.svg"
                            class="svg-inject text-primary is-16"
                            alt="" />
                    </button>
                    <div class="job-info">
                        <div class="job-image">
                            <?php if ($adu['nama_kategori'] == 'Layanan Publik'): ?>
                                <img src="./assets-home/assets/kategori/layananpublik.svg" alt="" />
                            <?php endif ?>
                            <?php if ($adu['nama_kategori'] == 'Infrastruktur dan Fasilitas Umum'): ?>
                                <img src="./assets-home/assets/kategori/infrastrruktur.svg" alt="" />
                            <?php endif ?>
                            <?php if ($adu['nama_kategori'] == 'Pendidikan'): ?>
                                <img src="./assets-home/assets/kategori/pendidikan.svg" alt="" />
                            <?php endif ?>
                            <?php if ($adu['nama_kategori'] == 'Kesehatan'): ?>
                                <img src="./assets-home/assets/kategori/kesehatan.svg" alt="" />
                            <?php endif ?>
                            <?php if ($adu['nama_kategori'] == 'Pelayanan Pemerintah'): ?>
                                <img src="./assets-home/assets/kategori/pemerintahan.svg" alt="" />
                            <?php endif ?>
                            <?php if ($adu['nama_kategori'] == 'Keamanan dan Ketertiban'): ?>
                                <img src="./assets-home/assets/kategori/keamanan.jpeg" alt="" />
                            <?php endif ?>
                        </div>
                        <div class="job-info-inner">
                            <h5 class="job-title">
                                <a><?= $adu['judul'] ?></a>
                            </h5>

                            <div class="job-author">
                                <a><?= $adu['nama_kategori'] ?></a>
                            </div>

                        </div>
                    </div>
                    <div
                        class="job-info-card-collapse collapse"
                        id="jobInfoCardCollapse">
                        <div class="job-info-card">
                            <div class="info-card">
                                <div
                                    class="info-card-icon bg-ufo-green-100 rounded-pill">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="info-card-content">
                                    <h6 class="info-card-title">

                                        <?= $adu['nama_instansi'] ?>

                                    </h6>
                                    <div class="info-card-desc">Tujuan</div>
                                </div>
                            </div>
                            <div class="info-card">
                                <div class="info-card-icon bg-rajah rounded-pill">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-card-content">
                                    <h6 class="info-card-title"><?php if ($adu['tipe_aduan'] == 'Anonim') {
                                                                    echo "Anonim";
                                                                } else {
                                                                    echo $adu['nama_masyarakat'];
                                                                } ?></h6>
                                    <div class="info-card-desc">Nama Pelapor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job-action">
                        <?php if ($adu['status'] == "Diajukan") : ?>
                            <div
                                class="bg-majorelle-blue-200 text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <?php if ($adu['status'] == "Terverifikasi") : ?>
                            <div
                                class="bg-ufo-green-100 text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <?php if ($adu['status'] == "Dialokasi") : ?>
                            <div
                                class="bg-pumpkin text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <?php if ($adu['status'] == "Dalam Proses") : ?>
                            <div
                                class="bg-mikado-yellow text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <?php if ($adu['status'] == "Selesai") : ?>
                            <div
                                class="bg-lime-green text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <?php if ($adu['status'] == "Ditolak") : ?>
                            <div
                                class="bg-orange-red text-white text-center flex-fill flex-md-nofill fw-semiBold py-12 px-43 rounded-pill">
                                <?= $adu['status'] ?>
                            </div>
                        <?php endif ?>
                        <a href="detail_aduan_masyarakat/<?= $adu['id_pengaduan'] ?>">
                            <button class="btn btn-rounded btn-book bg-primary">
                                <i class="fas fa-search"></i> Detail
                            </button>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- /.job-list -->

        <div class="d-flex justify-content-center mt-60">
            <?= $pager->links() ?>

        </div>
        <!-- /.job-list-pagination -->
    </div>
    <div class="mt-xl-43"></div>
    <!-- = /. Gap Section = -->
    <div class="container-xxl py-60">
        <div class="counter">
            <div class="count-item">
                <div class="count-number" data-count="<?= $total_user ?>">0</div>
                <div class="count-title">Total User</div>
            </div>
            <div class="count-item">
                <div class="count-number" data-count="<?= $total_pengaduan ?>">0</div>
                <div class="count-title">Total Aduan</div>
            </div>
            <div class="count-item">
                <div class="count-number" data-count="<?= $total_pengaduan_proses ?>">0</div>
                <div class="count-title">Aduan yang diproses</div>
            </div>
            <div class="count-item">
                <div class="count-number" data-count="<?= $total_pengaduan_selesai ?>">0</div>
                <div class="count-title">Aduan Selesai</div>
            </div>
        </div>
        <!-- /.counter-component -->
    </div>
    <!-- /.container -->
    <!-- = /. Counter Section = -->

    <!-- /.container -->
    <!-- = /. Featured Profile Slider Section = -->
</main>
<?= $this->endSection(); ?>