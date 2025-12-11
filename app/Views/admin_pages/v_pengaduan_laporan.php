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
                    <h5 class="card-title mb-0">Daftar Formulir Pengaduan</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <?php if (session()->get('level') == 'admin'): ?>
                                <div class="dt-responsive table-responsive nowrap">
                                    <table id="datatable" class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengadu</th>
                                                <th>Judul</th>
                                                <th>IsI</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengaduan as $adu):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td> <?php if ($adu['tipe_aduan'] == 'Anonim') {
                                                                echo "Anonim";
                                                            } else {
                                                                echo $adu['nama_pengadu'];
                                                            } ?></td>
                                                    <td><?= $adu['judul'] ?></td>
                                                    <td><?= $adu['isi'] ?></td>
                                                    <td class="text-center">
                                                        <a href="formulir_pengaduan/<?= $adu['id_pengaduan'] ?>" target="_blank">
                                                            <i class="mdi mdi-printer text-dark" style="font-size: 30px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- Modals -->
                                            <?php
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif ?>

                            <?php if (session()->get('level') == 'operator'): ?>
                                <a href="laporan_pengaduan" class="mb-3" target="_blank"><Button type="button" class="btn btn-md btn-success mb-2"><i data-feather="printer"></i> Print Pengaduan</Button></a>
                                <div class="dt-responsive table-responsive nowrap">
                                    <table id="datatable" class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengadu</th>
                                                <th>Judul</th>
                                                <th>IsI</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengaduanOP as $adu):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td> <?php if ($adu['tipe_aduan'] == 'Anonim') {
                                                                echo "Anonim";
                                                            } else {
                                                                echo $adu['nama_pengadu'];
                                                            } ?></td>
                                                    <td><?= $adu['judul'] ?></td>
                                                    <td><?= $adu['isi'] ?></td>
                                                    <td class="text-center">
                                                        <a href="formulir_pengaduan/<?= $adu['id_pengaduan'] ?>" target="_blank">
                                                            <i class="mdi mdi-printer text-dark" style="font-size: 30px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- Modals -->
                                            <?php
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- container-fluid -->
        <?= $this->endSection(); ?>