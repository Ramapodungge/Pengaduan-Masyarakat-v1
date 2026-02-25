<?= $this->extend('masyarakat_pages/template/template_masyarakat'); ?>
<?= $this->section('content-home'); ?>
<main class="main position-relative">
    <div class="detail-header-background">
        <img src="./assets-home/assets/detail-header-image-2560x330.png" alt="" />
    </div>
    <!-- /.detail-background -->

    <div class="container-xxl">
        <div class="position-relative py-43 py-lg-80">
            <div class="d-grid gap-10 text-center">
                <h4 class="heading-section-4 text-white mb-0">Buat Aduan</h4>
                <div class="heading-text-2 text-white">Mulai langkah awal penyelesaian dengan menyampaikan aduan
                    Anda di sini.</div>
            </div>
            <!-- /.heading-header -->

            <a class="position-absolute btn btn-rounded btn-white top-0 top-md-50 top-md start-0 translate-middle-md-y p-10 mt-15 mt-md-0"
                href="/">
                <i class="fas fa-arrow-left"></i>
            </a>
            <!-- /.btn-back -->
        </div>
    </div>
    <!-- /.container -->
    <!-- = /. Header Section = -->

    <div class="container-xxl">
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="d-grid d-xl-flex bg-white p-20 p-md-34 p-xxl-43 gap-34 rounded-20 shadow-2">
                    <div class="d-flex align-items-center">
                        <div class="d-grid gap-10">
                            <h2 class="heading-section-4 text-dark mb-0">Sampaikan Laporan / Aduan Anda</h2>
                            <div class="fs-14">Formulir Pengaduan</div>
                        </div>
                        <!-- /.job-title and job-meta -->
                    </div>
                </div>
            </div>

            <div class="d-grid bg-white p-20 p-md-34 p-xxl-43 mt-24 gap-34 rounded-20 shadow-2">
                <?php if (session()->getFlashdata('pesan_aduan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #47F58F;">
                        <strong>Berhasil!</strong> <?= session()->getFlashdata('pesan_aduan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" style="background-color: salmon;" role="alert">
                        <strong>Mohon Maaf!</strong> Ada beberapa kesalahan:
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="/masyarakat/buat_aduan" class="row" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="col-md-12 col-xl-12 my-15 my-xl-24">
                        <label class="form-label">Judul Aduan</label>
                        <input type="text" name="judul" class="form-control rounded-pill" placeholder="Type here" />
                    </div>
                    <!-- /.col -->
                    <div class="col-12 my-15 my-xl-24">
                        <label for="textareaAboutyou" class="form-label">Isi Laporan</label>
                        <textarea class="form-control" name="isi" id="textareaAboutyou" rows="5"
                            placeholder="Type here"></textarea>
                    </div>
                    <input type="hidden" value="<?= session()->get('nik') ?>" name="masyarakat">
                    <div class="col-md-6 col-xl-6 my-15 my-xl-24">
                        <label for="inputMiddlename" class="form-label">Kategori</label>
                        <select name="kategori" id="" class="form-control">
                            <option value="" hidden>Pilih</option>
                            <?php foreach ($kategori as $kat): ?>
                                <?php if (session()->get('role') == 'warga'): ?>
                                    <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                <?php endif ?>
                                <?php if (session()->get('role') == 'tamu'):
                                    if ($kat['nama_kategori'] == 'Layanan Publik' || $kat['nama_kategori'] == 'Infrastruktur dan Fasilitas Umum' || $kat['nama_kategori'] == 'Keamanan dan Ketertiban') {
                                ?>
                                        <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                <?php
                                    }
                                endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6 col-xl-6 my-15 my-xl-24">
                        <label for="inputLastname" class="form-label">Instansi Tujuan</label>
                        <select name="instansi" id="" class="form-control">
                            <option value="" hidden>Pilih</option>
                            <?php foreach ($instansi as $ins): ?>
                                <option value="<?= $ins['id_instansi'] ?>"><?= $ins['nama_instansi'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- /.col -->

                    <div class="col-12 my-15 my-xl-24">
                        <label class="form-label">Attach your resume</label>
                        <div class="form-upload">
                            <!-- Upload Zone -->
                            <div class="upload-item upload-zone" id="uploadZone"
                                onclick="document.getElementById('fileInput').click()">
                                <input type="file" id="fileInput" name="filefoto"
                                    accept=".ppt,.jpg,.jpeg,.png" style="display: none;">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud"></i>
                                </div>
                                <div class="file-info">
                                    <div class="file-info-title">Upload Foto</div>
                                    <div class="file-info-detail">JPG/PNG dan JPEG</div>
                                </div>
                            </div>

                            <!-- Uploaded File Preview (Hidden by default) -->
                            <div class="upload-item" id="uploadedFile" style="display: none;">
                                <div class="upload-icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="file-info">
                                    <div class="file-info-title" id="fileName">Contact_2020.pdf</div>
                                    <div class="file-info-detail" id="fileSize">456 KB</div>
                                </div>
                                <button class="action-delete" id="deleteFile">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Tipe Aduan</label>
                    <div class="checkbox-type type-1">
                        <input class="checkbox-type-input" type="checkbox" value="Umum" name="tipeaduan" id="cek0" />
                        <label class="checkbox-type-label" for="cek0">
                            <div class="checkbox-type-icon">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="checkbox-type-text fw-semiBold">Umum</div>
                        </label>
                    </div>
                    <div class="checkbox-type type-1">
                        <input class="checkbox-type-input" type="checkbox" value="Anonim" name="tipeaduan" id="cek1" />
                        <label class="checkbox-type-label" for="cek1">
                            <div class="checkbox-type-icon">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="checkbox-type-text fw-semiBold">Anonim</div>
                        </label>
                    </div>
                    <div class="checkbox-type type-1">
                        <input class="checkbox-type-input" type="checkbox" value="Rahasia" name="tipeaduan" id="cek2" />
                        <label class="checkbox-type-label" for="cek2">
                            <div class="checkbox-type-icon">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="checkbox-type-text fw-semiBold">Rahasia</div>
                        </label>
                    </div>

                    <div class="col-12 d-flex my-15 my-xl-24">
                        <button type="submit" class="btn btn-primary fw-semiBold py-12 px-24 px-md-60 rounded-pill"
                            role="button">Submit</button>
                        <!-- /.btn-submit -->

                        <button type="reset" class="btn btn-cultured text-philippine-gray fw-semiBold py-12 px-20 ms-auto rounded-pill"
                            href="#" role="button">Cancel</button>
                        <!-- /.btn-cancel -->
                    </div>
                    <!-- /.col -->
                </form>
                <!-- /.row -->
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