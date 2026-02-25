<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
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
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Pengaduan</h4>
            <?php if (session()->get('level') == 'admin'): ?>
                <span style="float: right;"><a href="/admin/daftaraduan" class="text-dark"><span class="badge bg-dark rounded align-items-center p-2">kembali</span></a></span>
            <?php endif ?>
            <?php if (session()->get('level') == 'operator'): ?>
                <span style="float: right;"><a href="/admin/daftaraduanoperator" class="text-dark"><span class="badge bg-dark rounded align-items-center p-2">kembali</span></a></span>
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Pengaduan</h5>
                </div><!-- end card header -->
                <div class="card-body">
                    <?php foreach ($aduan as $adu): ?>
                        <h2><?= $adu['judul'] ?></h2>
                        <h6><i data-feather="user"></i> <?php if ($adu['tipe_aduan'] == 'Anonim') {
                                                            echo "Anonim";
                                                        } else {
                                                            echo $adu['nama_pengadu'];
                                                        } ?> - <i data-feather="calendar"></i> <?= formatTanggalIndonesiaWITA($adu['created_at']) ?></h6>
                        <h6><?php if ($adu['tipe_aduan'] == 'Anonim') {
                                echo "-";
                            } else {
                                echo 'NIK:' . $adu['nik'];
                            } ?> - <i data-feather="map-pin"></i> Tujuan : <?= $adu['nama_instansi'] ?> - <i data-feather="layers"></i> Status : <span class="text-info"><?= $adu['status'] ?></span>
                        </h6>
                        <hr>
                        <p><?= $adu['isi'] ?></p>
                        <img src="foto_laporan/<?= $adu['foto'] ?>" width="50%" alt="" id="myImage" style="cursor: pointer;" onclick="showFullImage()">
                        <img src="foto_laporan/<?= $adu['foto'] ?>" alt="" id="fullImage" style="display:none; width: 100%; height: 100vh; cursor:pointer;" onclick="showThumbnail()">
                        <div class="mt-3 d-flex gap-2">
                            <?php if ($adu['status'] == "Diajukan"): ?>
                                <form method="post" action="/admin/terima_pengaduan/<?= $adu['id_pengaduan'] ?>">
                                    <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                    <button type="submit" class="btn btn-xl btn-info">Terima</button>
                                </form>
                            <?php endif ?>
                            <?php if ($adu['status'] == "Terverifikasi"): ?>
                                <a data-bs-toggle="modal" data-bs-target="#bs-example-modal-terima<?= $adu['id_pengaduan'] ?>"><button type=" button" class="btn btn-xl btn-success">Alokasi</button></a>
                                <?php if ($adu['nama_instansi'] == 'Kecamatan Kabila Bone'): ?>
                                    <form method="post" action="/admin/proses_pengaduan/<?= $adu['id_pengaduan'] ?>">
                                        <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                        <button type="submit" class="btn btn-xl btn-warning">Proses</button>
                                    </form>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if ($adu['status'] == "Dialokasi"):
                                if (session()->get('level') == 'operator'):
                            ?>
                                    <form method="post" action="/admin/proses_pengaduan/<?= $adu['id_pengaduan'] ?>">
                                        <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                        <button type="submit" class="btn btn-xl btn-warning">Proses</button>
                                    </form>
                            <?php
                                endif;
                            endif ?>
                            <?php if ($adu['status'] == "Dalam Proses"):
                                if ($adu['id_instansi'] == session()->get('instansi_id')) {
                            ?>
                                    <a data-bs-toggle="modal" data-bs-target="#bs-example-modal-selesai<?= $adu['id_pengaduan'] ?>"><button type="button" class="btn btn-xl btn-info">Selesai</button></a>
                            <?php
                                }
                            endif ?>

                            <?php if ($adu['status'] == "Diajukan"): ?>
                                <a data-bs-toggle="modal" data-bs-target="#bs-example-modal-center<?= $adu['id_pengaduan'] ?>"><button type="button" class="btn btn-xl btn-danger">Tolak</button></a>
                            <?php endif ?>
                        </div>
                        <!-- Modals Selsai -->
                        <div class="modal fade" id="bs-example-modal-selesai<?= $adu['id_pengaduan'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Selesai Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form method="post" class="row g-3" id="uploadForm" action="/admin/selesai_pengaduan/<?= $adu['id_pengaduan'] ?>" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class=" modal-body">
                                            <div class="col-12 mt-3">
                                                <label for="validationDefault01" class="form-label">Dokumen Bukti</label>
                                                <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                                <input type="file" class="form-control" name="file" id="file" required>
                                                <p id="error-message" style="color: red; display: none;"></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!-- Modals Terima -->
                        <div class="modal fade" id="bs-example-modal-terima<?= $adu['id_pengaduan'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Terima Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form class="row g-3" method="POST" action="/admin/alokasi_pengaduan/<?= $adu['id_pengaduan'] ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <div class="col-12 mt-3">
                                                <label for="validationDefault01" class="form-label">Alokasi</label>
                                                <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                                <select name="instansi_id" id="" class="form-control">
                                                    <option value="<?= $adu['id_instansi'] ?>"><?= $adu['nama_instansi'] ?></option>
                                                    <?php foreach ($alokasi as $alok):
                                                    ?>
                                                        <option value="<?= $alok['id_instansi'] ?>"><?= $alok['nama_instansi'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <!-- Modals Tolak -->
                        <div class="modal fade" id="bs-example-modal-center<?= $adu['id_pengaduan'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tolak Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form class="row g-3" method="POST" action="/admin/tolak_pengaduan/<?= $adu['id_pengaduan'] ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <div class="col-12 mt-3">
                                                <label for="validationDefault01" class="form-label">Alasan</label>
                                                <textarea class="form-control" name="tolak" id=""></textarea>
                                                <input type="hidden" name="email" value="<?= $adu['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Timline</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <ul class="simple-timeline mb-0">
                        <?php foreach ($timline as $time): ?>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-dot timeline-dot-info"></span>
                                <div class="timeline-time mt-3">
                                    <div class="timeline-header-section mb-2">
                                        <h5 class="mb-0">
                                            <?php if ($time['status'] == "Diajukan") {
                                                echo "<span class='badge bg-primary'>Menunggu Verifikasi</span>";
                                            } else if ($time['status'] == "Terverifikasi") {
                                                echo "<span class='badge bg-success'>Pengaduan Terverifikasi</span>";
                                            } else if ($time['status'] == "Dialokasi") {
                                                echo "<span class='badge bg-secondary'>Pengaduan Dialokasikan</span>";
                                            } else if ($time['status'] == "Dalam Proses") {
                                                echo "<span class='badge bg-warning'>Dalam Proses</span>";
                                            } else if ($time['status'] == "Selesai") {
                                                echo "<span class='badge bg-success'>Selseai</span>";
                                            } else if ($time['status'] == "Ditolak") {
                                                echo "<span class='badge bg-danger'>Laporan Ditolak</span>";
                                            }
                                            ?>
                                        </h5>
                                        <small class="text-muted"><?= formatTanggalIndonesiaWITA($time['created_att'])  ?></small>
                                    </div>
                                    <p class="mb-2">
                                        <?= $time['judul'] ?>
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <div>
                                            <p class="mb-0 small fw-medium">
                                                <?php if ($time['status'] != "Ditolak"): ?>
                                                    <?= ucwords(substr($time['keterangan'], 14)) ?>
                                                <?php endif ?>
                                                <?php if ($time['status'] == "Ditolak"): ?>
                                                    <?= $time['keterangan'] ?>
                                                <?php endif ?>
                                            </p>
                                            <small>Alamat Pengadu : <?php if ($time['tipe_aduan'] == 'Anonim') {
                                                                        echo "Di Rahasiakan";
                                                                    } else {
                                                                        echo $time['alamat'];
                                                                    } ?></small><br>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div> <!-- container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Feedback</h5>
                </div><!-- end card header -->
                <div class="card-body">
                    <ul class="list-group list-group-flush list-group-no-gutters">
                        <?php foreach ($feedback as $feed): ?>
                            <!-- List Item -->
                            <li class="list-group-item">
                                <div class="d-flex">

                                    <div class="flex-shrink-0 align-self-center">
                                        <!-- Avatar -->
                                        <div
                                            class="align-content-center text-center border border-dashed rounded-circle p-1">
                                            <i data-feather="user" class="avatar avatar-sm rounded-circle"></i>
                                        </div>
                                        <!-- End Avatar -->
                                    </div>

                                    <div class="flex-grow-1 ms-3 align-content-center">
                                        <div class="row">
                                            <div class="col-12 col-md-12 order-md-1">
                                                <h6 class="mb-1 text-dark fs-15"><?php if ($feed['tipe_aduan'] == 'Anonim') {
                                                                                        echo "Anonim";
                                                                                    } else {
                                                                                        echo $feed['email'];
                                                                                    } ?></h6>
                                                <span class="fs-14 text-muted"><?= $feed['feedback'] ?> </span><br>
                                                <span class="fs-14 text-muted mt-2 fs-8" style="float: right;">Dibuat: <?= formatTanggalIndonesiaWITA($feed['waktu_kirim']) ?> </span>
                                            </div>
                                        </div>
                                        <!-- End Row -->
                                    </div>

                                </div>
                            </li>
                        <?php endforeach ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>