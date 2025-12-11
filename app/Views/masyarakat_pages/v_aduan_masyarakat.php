<?= $this->extend('masyarakat_pages/template/template_masyarakat'); ?>
<?= $this->section('content-home'); ?>
<main class="main position-relative">
    <div class="header-background">
        <div

            </figure>
            <!-- /.svg-decoration -->
        </div>
    </div>
    <!-- = /. Header Background with Figure = -->

    <div class="container-xxl position-relative py-60">


        <figure class="position-absolute top-0 start-50 translate-middle-x" style="z-index: -1;">
            <svg width="1287" height="466" viewBox="0 0 1287 466" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="1265" cy="202" r="22" fill="#E0E6FF" />
                <circle cx="919.5" cy="27.5" r="9.5" fill="#E0E6FF" />
                <circle cx="53.5" cy="122.5" r="9.5" fill="#E0E6FF" />
                <circle cx="27" cy="439" r="27" fill="#E0E6FF" />
                <circle cx="448" cy="12" r="12" fill="#E0E6FF" />
            </svg>
        </figure>
        <div class="d-grid gap-20 w-xl-60 w-xxl-50 mx-auto text-center">
            <img
                src="./assets-home/assets/logo-only.png"
                class="is-80 is-lg-100 mx-auto"
                alt="logo" />
            <div class="heading-header-2 fw-medium lh-base text-black">
                Menampilkan daftar lengkap aduan yang diterima melalui
                <span class="fw-bold text-primary"> RuangSuara.</span>
            </div>
        </div>
        <!-- /.heading-header -->

        <form class="mt-34 mt-xl-60 w-xl-70 w-xxl-60 mx-auto" id="searchForm" method="GET">
            <div class="form-search-filter gap-20 gap-md-0">
                <div class="d-flex gap-20 gap-md-0 flex-md-fill order-2 order-md-1">
                    <!-- Dropdown Instansi -->
                    <select name="instansi" id="instansi" class="form-select select-icon icon-mark" aria-label="select location">
                        <option value="">Instansi</option>
                        <?php foreach ($instansi as $ins): ?>
                            <option value="<?= $ins['id_instansi'] ?>" <?= ($instansi_id == $ins['id_instansi']) ? 'selected' : '' ?>>
                                <?= $ins['nama_instansi'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <!-- Dropdown Kategori -->
                    <select name="kategori" id="kategori" class="form-select" aria-label="select title">
                        <option value="">Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['id_kategori'] ?>" <?= ($kategori_id == $kat['id_kategori']) ? 'selected' : '' ?>>
                                <?= $kat['nama_kategori'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-search-input flex-lg-fill order-1 order-md-2">
                    <!-- Input Pencarian Judul -->
                    <input class="form-control" name="search" id="search" type="search" placeholder="Search" aria-label="Search" value="<?= isset($search) ? $search : '' ?>" />
                </div>
            </div>
        </form>



        <!-- /.search-filter-form -->
    </div>
    <!-- = /. Header Section = -->

    <div class="mt-43"></div>
    <!-- = /. Gap Section = -->

    <div class="container-xxl py-60">
        <div class="row align-items-center">
            <div class="col-8">
                <h4 class="heading-section-4 text-dark mb-0">
                    Daftar Data Aduan
                </h4>
                <h6 class=" text-dark mb-0">Menampilkan Data Pencarian Data</h6>
            </div>
            <!-- /.col -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.heading-section -->
        <div id="tabelAduan">

            <div class="position-relative profile-card-slider mt-lg-25">
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
                    <?php
                    endforeach ?>
                    <!-- /.job-card-grid-harizontal-component -->
                </div>
            </div>
            <div class="d-flex justify-content-center mt-60">
                <?= $pager->links() ?>

            </div>
        </div>
    </div>
    <!-- /.container -->
    <!-- = /. Featured Profile Slider Section = -->

    <div class="mt-43"></div>
    <!-- = /. Gap Section = -->


</main>
<!-- = /. Main Section = -->
<?= $this->endSection(); ?>