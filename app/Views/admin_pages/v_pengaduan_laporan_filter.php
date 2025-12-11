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
                    <h5 class="card-title mb-0">Filter Pengaduan</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <form id="filterForm" method="get" class="mb-4 form-group">
                        <div class="row">
                            <div class="col-6">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">-- Pilih Tahun --</option>
                                    <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                                        <option value="<?= $i ?>" <?= ($i == ($tahun ?? '')) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">-- Pilih Bulan --</option>
                                    <?php
                                    $bulanList = [
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember'
                                    ];
                                    foreach ($bulanList as $key => $val): ?>
                                        <option value="<?= $key ?>" <?= ($key == ($bulan ?? '')) ? 'selected' : '' ?>><?= $val ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                    </form>


                </div>

            </div>
        </div>
        <div id="filteredData"></div> <!-- Menampilkan hasil filter -->
    </div>
</div>
<?= $this->endSection(); ?>