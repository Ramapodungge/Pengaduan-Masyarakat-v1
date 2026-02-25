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
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Pengaduan</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-2 mb-2 active" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Dialokasi</a>
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Dalam Proses</a><a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-selesai" role="tab" aria-controls="v-pills-settings" aria-selected="false">Selesai</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active dt-responsive table-responsive" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <table id="datatable3" class="table table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengadu</th>
                                                <th>Judul</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($dialokasi as $alo):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php if ($alo['tipe_aduan'] == 'Anonim') {
                                                            echo "Anonim";
                                                        } else {
                                                            echo $alo['nama_pengadu'];
                                                        } ?></td>
                                                    <td><?= $alo['judul'] ?>
                                                        <span class="d-block text-success">
                                                            Dibuat : <?= formatTanggalIndonesiaWITA($alo['created_at'])  ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/admin/detail_pengaduan/<?= $alo['id_pengaduan'] ?>" aria-label="anchor" class="col-12 btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit">
                                                            <i class="mdi mdi-eye-outline fs-14 text-primary"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade dt-responsive table-responsive" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <table id="datatable4" class="table table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengadu</th>
                                                <th>Judul</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($dalamproses as $dal):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php if ($dal['tipe_aduan'] == 'Anonim') {
                                                            echo "Anonim";
                                                        } else {
                                                            echo $dal['nama_pengadu'];
                                                        } ?></td>
                                                    <td><?= $dal['judul'] ?>
                                                        <span class="d-block text-success">
                                                            Dibuat : <?= formatTanggalIndonesiaWITA($dal['created_at'])  ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/admin/detail_pengaduan/<?= $dal['id_pengaduan'] ?>" aria-label="anchor" class="col-12 btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit">
                                                            <i class="mdi mdi-eye-outline fs-14 text-primary"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade dt-responsive table-responsive" id="v-pills-selesai" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <table id="datatable5" class="table table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengadu</th>
                                                <th>Judul</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($selesai as $sel):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php if ($sel['tipe_aduan'] == 'Anonim') {
                                                            echo "Anonim";
                                                        } else {
                                                            echo $sel['nama_pengadu'];
                                                        } ?></td>
                                                    <td><?= $sel['judul'] ?>
                                                        <span class="d-block text-success">
                                                            Dibuat : <?= formatTanggalIndonesiaWITA($sel['created_at'])  ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/admin/detail_pengaduan/<?= $sel['id_pengaduan'] ?>" aria-label="anchor" class="col-12 btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit">
                                                            <i class="mdi mdi-eye-outline fs-14 text-primary"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>

                </div>
            </div> <!-- container-fluid -->
            <?= $this->endSection(); ?>