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

<div class="card mt-4" id="filteredData">
    <div class="card-header">
        <h5 class="card-title">Hasil Pengaduan</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/admin/PDFLaporanfilter'); ?>" method="get" target="_blank">
            <input type="hidden" value="<?= $tahun ?>" name="tahun">
            <input type="hidden" value="<?= $bulan ?>" name="bulan">
            <button type="submit" class="btn btn-md btn-success mb-2"><i data-feather="printer"></i> Print Pengaduan</button>
        </form>
        <table id="pengaduanTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengadu</th>
                    <th>Kategori</th>
                    <th>Instansi</th>
                    <th>Tanggal Pengaduan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pengaduan)): ?>
                    <?php foreach ($pengaduan as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['nama_masyarakat'] ?></td>
                            <td><?= $item['nama_kategori'] ?></td>
                            <td><?= $item['nama_instansi'] ?></td>
                            <td><?= formatTanggalIndonesiaWITA($item['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pengaduan untuk filter yang dipilih</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#pengaduanTable').DataTable();
    });

    feather.replace();
</script>