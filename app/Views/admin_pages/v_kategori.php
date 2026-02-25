<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Ketegori</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Ketegori</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="">

                        <table id="datatable" class="table table-bordered  nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Ketegori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($kategori as $kat):
                                ?>
                                    <tr>
                                        <td><?= $kat['nama_kategori'] ?></td>
                                        <td class="text-end">
                                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit" data-bs-toggle="modal" data-bs-target="#bs-example-modal-center<?= $kat['id_kategori'] ?>">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="hapusKategori(<?= $kat['id_kategori']; ?>)">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modals -->
                                    <div class="modal fade" id="bs-example-modal-center<?= $kat['id_kategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <form class="row g-3" method="POST" action="/admin/ubah_kategori/<?= $kat['id_kategori'] ?>">
                                                    <div class="modal-body">
                                                        <div class="col-12 mt-3">
                                                            <label for="validationDefault01" class="form-label">Nama Kategori</label>
                                                            <input type="text" name="nama_kategori" class="form-control" value="<?= $kat['nama_kategori'] ?>" placeholder="Masukan Nama kategori" id="validationDefault01" required>
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
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Form Input</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <form class="row g-3" method="POST" action="admin/simpan_kategori">
                        <div class="col-12">
                            <label for="validationDefault01" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Nama Kategori" id="validationDefault01" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Deskripsi</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <button type="button" class="mb-3 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-center002">
                    <i class="mdi mdi-plus fs-14 text-white"></i> Tambah data
                </button>
                <div class="table-responsive">
                    <table id="datatable2" class="table table-bordered dt-responsive  nowrap">
                        <thead>
                            <tr>
                                <th>Deskripsi Kategori</th>
                                <th>Nama Ketegori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($deskripsi as $des):
                            ?>
                                <tr>
                                    <td><?= $des['isi_deskripsi'] ?></td>
                                    <td><?= $des['nama_kategori'] ?></td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-original-title="Edit" data-bs-toggle="modal" data-bs-target="#bs-example-modal-center<?= $des['id_deskripsi'] ?>">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="hapusDeskripsi(<?= $des['id_deskripsi']; ?>)">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modals -->
                                <div class="modal fade" id="bs-example-modal-center<?= $des['id_deskripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <form class="row g-3" method="POST" action="/admin/ubah_deskripsi/<?= $des['id_deskripsi'] ?>">
                                                <div class="modal-body">
                                                    <div class="col-12 mt-3">
                                                        <label for="example-textarea" class="form-label">Text area</label>
                                                        <textarea name="isi_deskripsi" class="form-control" id="example-textarea" rows="5" spellcheck="false"><?= $des['isi_deskripsi'] ?></textarea>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <label for="example-textarea" class="form-label">Kategori</label>
                                                        <select class="form-control" name="id_kategori" id="">
                                                            <option value="<?= $des['id_kategori'] ?>"><?= $des['nama_kategori'] ?></option>
                                                            <?php
                                                            foreach ($kategori as $kat2):
                                                            ?>
                                                                <option value="<?= $kat2['id_kategori'] ?>"><?= $kat2['nama_kategori'] ?></option>
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
                                <?php
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <div class="modal fade" id="bs-example-modal-center002" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="row g-3" method="POST" action="admin/tambah_deskripsi">
                    <div class="modal-body">
                        <div class="col-12 mt-3">
                            <label for="example-textarea" class="form-label">Text area</label>
                            <textarea name="isi_deskripsi" class="form-control" id="example-textarea" rows="5" spellcheck="false"></textarea>
                        </div>
                        <div class="col-12A mt-3">
                            <label for="example-textarea" class="form-label">Kategori</label>
                            <select class="form-control" name="id_kategori" id="">
                                <?php
                                foreach ($kategori as $kat2):
                                ?>
                                    <option value="<?= $kat2['id_kategori'] ?>"><?= $kat2['nama_kategori'] ?></option>
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
</div> <!-- container-fluid -->
<?= $this->endSection(); ?>