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
        <div class="position-relative py-43 py-lg-80">
            <div class="d-grid gap-10 text-center">
                <h4 class="heading-section-4 text-white mb-0">Profil</h4>
                <div class="heading-text-2 text-white">
                    <p class="text-white text-decoration-none" href="#">
                        Lihat data pribadi dan daftar aduan yang telah disampaikan.
                    </p>
                </div>
            </div>
            <!-- /.heading-header -->

            <a
                class="position-absolute btn btn-rounded btn-white top-0 top-md-50 top-md start-0 translate-middle-md-y p-10 mt-15 mt-md-0"
                href="/">
                <i class="fas fa-arrow-left"></i>
            </a>
            <!-- /.btn-back -->

            <!-- /.btn-book-mobile -->
        </div>
    </div>

    <div class="container-xxl">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-9 order-lg-2">
                <div
                    class="d-grid bg-white p-20 p-md-34 p-xxl-43 gap-34 rounded-20 shadow-2">
                    <div class="d-flex align-items-center">
                        <div class="d-grid gap-10">
                            <h2 class="heading-section-4 text-dark mb-0">
                                Daftar Aduan Saya
                            </h2>
                        </div>
                        <!-- /.job-title and job-meta -->
                    </div>

                    <div class="d-grid">
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
                                                <a href="detail_aduan_masyarakat/<?= $adu['id_pengaduan'] ?>"><?= $adu['judul'] ?></a>
                                            </h5>

                                            <div class="job-author">
                                                <a href="detail_aduan_masyarakat/<?= $adu['id_pengaduan'] ?>"><?= $adu['nama_kategori'] ?></a>
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
                                                    <h6 class="info-card-title"><?= session()->get('nama') ?></h6>
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
                    <!-- /.job-list-pagination -->
                    <!-- /.job-description -->

                    <!-- /.gap -->
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-lg-4 col-xl-3 mt-20 mt-lg-0 order-lg-1">
                <div class="d-grid gap-34 bg-white p-20 py-43 rounded-20 shadow-2">
                    <div class="d-grid text-center gap-34 mx-auto">
                        <img
                            src="https://ui-avatars.com/api/?name=<?= esc($pengguna1row['nama_pengadu']) ?>"
                            class="img-avatar mx-auto rounded-pill"
                            alt="job-logo-1" />
                        <!-- /.company-image -->

                        <div class="d-grid gap-10">
                            <h6 class="heading-text-1 fw-medium mb-0">
                                <a class="text-dark text-decoration-none" href="#"><?= esc($pengguna1row['nama_pengadu']) ?></a>
                            </h6>
                            <div class="fs-14">
                                <a class="text-gray text-decoration-none" href="#"><?= esc($pengguna1row['nik']) ?></a>
                            </div>
                        </div>
                        <!-- /.company-info -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="info-card">
                                <div class="info-card-icon bg-blue-violet">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-card-content gap-5 flex-fill">
                                    <h6 class="info-card-title fw-semiBold">Email</h6>
                                    <div class="info-card-desc"><?= esc($pengguna1row['email']) ?></div>
                                </div>
                            </div>
                            <!-- /.info-card-component -->
                        </div>
                        <!-- /.col -->

                        <div class="col-12 mt-10">
                            <div class="info-card">
                                <div class="info-card-icon bg-mikado-yellow">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="info-card-content gap-5 flex-fill">
                                    <h6 class="info-card-title fw-semiBold">Tanggal Lahir</h6>
                                    <div class="info-card-desc"><?= merubah_tanggal(session()->get('tgl_lahir')) ?></div>
                                </div>
                            </div>
                            <!-- /.info-card-component -->
                        </div>
                        <!-- /.col -->

                        <div class="col-12 mt-10">
                            <div class="info-card">
                                <div class="info-card-icon bg-lime-green">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-card-content gap-5 flex-fill">
                                    <h6 class="info-card-title fw-semiBold">No Telpon</h6>
                                    <div class="info-card-desc"><?= esc($pengguna1row['no_telpon']) ?></div>
                                </div>
                            </div>
                            <!-- /.info-card-component -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 mt-10">
                            <div class="info-card">
                                <div class="info-card-icon bg-persian-blue">
                                    <i class="fas fa-location"></i>
                                </div>
                                <div class="info-card-content gap-5 flex-fill">
                                    <h6 class="info-card-title fw-semiBold">Alamat</h6>
                                    <div class="info-card-desc"><?= esc($pengguna1row['alamat']) ?></div>
                                </div>
                            </div>
                            <!-- /.info-card-component -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="d-flex align-items-center gap-15">
                        <a
                            href="#"
                            class="btn btn-apply fw-semiBold py-12 w-100 rounded-pill"
                            data-bs-original-title="Edit"
                            data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-center">Ubah Password</a>
                        <!-- /.btn-vacancy -->

                        <a
                            href="#"
                            class="btn btn-white text-dark fw-semiBold py-12 w-100 border border-platinum rounded-pill shadow-none"
                            data-bs-original-title="Edit Data"
                            data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-center4">Edit Data</a>
                        <!-- /.btn-more-detail -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</main>
<!-- Modals -->
<div class="modal fade" id="bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="row g-3" method="POST" action="/masyarakat/reset-password-masyrakat/<?= session()->get('nik') ?>">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" class="form-control" type="password" required="" id="password" placeholder="Masukan Password Anda">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Konfirmasi Password</label>
                        <input name="konfirmasi_password" class="form-control" type="password" required="" id="confirm_password" placeholder="Masukan Kembali Password Anda">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Modals -->
<?php foreach ($penggunarow as $adus): ?>
    <div class="modal fade" id="bs-example-modal-center4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <form class="row" method="POST" action="/masyarakat/update-data-masyrakat/<?= session()->get('nik') ?>">
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Nama Lengkap</label>
                            <input name="nama" class="form-control" type="text" required="" value="<?= $adus['nama_pengadu'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control"><?= $adus['alamat'] ?></textarea>
                        </div>
                        <div class="form-group mb-5">
                            <label for="password" class="form-label">No Hp</label>
                            <input name="nohp" class="form-control" type="text" required="" value="<?= $adus['no_telpon'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php endforeach ?>
<?= $this->endSection(); ?>