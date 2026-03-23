<?= $this->extend('admin_pages/template/template_admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Operator</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Operator</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nama Operator</th>
                                <th>Nama Instansi</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($operator as $ope):
                                if ($ope['level'] != 'Admin'):
                            ?>
                                    <tr>
                                        <td><?= $ope['nama_admin'] ?></td>
                                        <td><?= $ope['nama_instansi'] ?></td>
                                        <td><?= $ope['username'] ?></td>
                                <?php
                                endif;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
<?= $this->endSection(); ?>