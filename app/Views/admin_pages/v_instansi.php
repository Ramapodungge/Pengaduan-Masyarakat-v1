<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Instansi</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Instansi</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Instansi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($instansi as $ins):
                                if ($ins['nama_instansi'] != 'Kecamatan Kabila Bone'):
                            ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ins['nama_instansi'] ?></td>
                                        <td class="text-end">
                                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit" data-bs-toggle="modal" data-bs-target="#bs-example-modal-center<?= $ins['id_instansi'] ?>">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="hapusInstansi(<?= $ins['id_instansi']; ?>)">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modals -->
                                    <div class="modal fade" id="bs-example-modal-center<?= $ins['id_instansi'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <form class="row g-3" method="POST" action="/admin/ubah_instansi/<?= $ins['id_instansi'] ?>">
                                                    <div class="modal-body">
                                                        <div class="col-12 mt-3">
                                                            <label for="validationDefault01" class="form-label">Nama Instansi</label>
                                                            <input type="text" name="nama_instansi" class="form-control" value="<?= $ins['nama_instansi'] ?>" placeholder="Masukan Nama Instansi" id="validationDefault01" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                <?php
                                endif;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Form Input</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <form class="row g-3" method="POST" action="/admin/simpan_instansi">
                        <div class="col-12">
                            <label for="validationDefault01" class="form-label">Nama Instansi</label>
                            <input type="text" name="nama_instansi" class="form-control" placeholder="Masukan Nama Instansi" id="validationDefault01" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div> <!-- container-fluid -->
<?= $this->endSection(); ?>