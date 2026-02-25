<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Profile</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <img src="assets/images/small/bg-faqs.png" class="rounded-top-2 img-fluid" alt="image data">

                <div class="card-body">
                    <div class="align-items-center">

                        <div class="hando-main-sections">
                            <div class="hando-profile-main">
                                <img src="assets/images/users/user-20.jpg" class="rounded-circle img-fluid avatar-xxl img-thumbnail float-start" alt="image profile">

                                <!-- <span class="sil-profile_main-pic-change img-thumbnail">
                                    <i class="mdi mdi-camera text-white"></i>
                                </span> -->
                            </div>

                            <div class="overflow-hidden ms-md-4 ms-0">
                                <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0"><?= esc($pengguna1row['nama_admin']) ?></h4>
                                <p class="my-1 text-muted fs-16"><span>Role : </span><?= session()->get('level') ?></p>
                                <div class="mb-2"><span>Email : </span><?= esc($pengguna1row['username']) ?></div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-center<?= session()->get('admin_id') ?>">Setting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <div class=" modal fade" id="bs-example-modal-center<?= session()->get('admin_id') ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="row g-3" method="POST" action="/admin/update_profile/<?= esc($pengguna1row['id_admin']) ?>">
                    <div class="modal-body">
                        <div class="col-12 mt-3">
                            <label for="validationDefault01" class="form-label">Nama Operator</label>
                            <input type="text" name="nama" class="form-control" value="<?= esc($pengguna1row['nama_admin']) ?>" required>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="validationDefault01" class="form-label">Pasword Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Pasword Baru" id="password" required>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="validationDefault01" class="form-label">Konfirmasi Pasword</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm_password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> <!-- container-fluid -->
    <?= $this->endSection(); ?>