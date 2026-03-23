<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Masyarakat</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Masyarakat</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <a href="/admin/laporan_masyarakat" class="mb-3" target="_blank"><Button type="button" class="btn btn-md btn-success mb-2"><i data-feather="printer"></i> Print Masyarakat</Button></a>
                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Alaamat</th>
                                <th>Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($masyarakat as $mas):
                            ?>
                                <tr>
                                    <td><?= $mas['nama_pengadu'] ?></td>
                                    <td><?= $mas['email'] ?></td>
                                    <td><?= $mas['alamat'] ?></td>
                                    <td>
                                        <?= $mas['pekerjaan'] ?><br>
                                        <?php if ($mas['pekerjaan'] == 'Profesional' || $mas['pekerjaan'] == 'Wirausaha' || $mas['pekerjaan'] == 'Pemerintahan'): ?>
                                            <ul>
                                                <li> <span>Instansi</span> <span>:<?= $mas['instansi'] ?></span><br></li>

                                                <li><span>Jabatan</span><span>:<?= $mas['jabatan'] ?></li>
                                            </ul>
                                        <?php endif ?>
                                        <?php if ($mas['pekerjaan'] == 'Pelajar/Mahasiswa/Akademisi'): ?>
                                            <ul>
                                                <li> <span>Universitas</span> <span>:<?= $mas['kampus'] ?></span><br></li>

                                                <li><span>Jurusan</span><span>:<?= $mas['jurusan'] ?></li>
                                            </ul>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <!-- Modals -->
                            <?php
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
<?= $this->endSection(); ?>