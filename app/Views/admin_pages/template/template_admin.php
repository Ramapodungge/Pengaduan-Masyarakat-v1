<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $title ?> || Sistem Informasi Pengaduan</title>
    <base href="<?= base_url('assets'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- sweet alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Datatables css -->
    <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />


    <!-- App favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/head.js"></script>


</head>

<!-- body start -->
<style>
    .card-chart {
        display: flex;
        overflow: auto;
        justify-content: center;
        align-items: center;
        height: 450px;
        /* bisa disesuaikan */
    }

    #chartPengaduan {
        width: 450px !important;
        height: 450px !important;
    }

    #fullImage {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        object-fit: contain;
    }
</style>

<body data-menu-color="light" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">

        <!-- Topbar Start -->
        <div class="topbar-custom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li>
                            <button class="button-toggle-menu nav-link">
                                <i data-feather="menu" class="noti-icon"></i>
                            </button>
                        </li>
                        <li class="d-none d-lg-block">
                            <h5 class="mb-0">Selamat Datang, <?= session()->get('nama') ?></h5>
                        </li>
                    </ul>

                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <!-- Button Trigger Customizer Offcanvas -->
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" data-toggle="fullscreen">
                                <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                            </button>
                        </li>

                        <!-- Light/Dark Mode Button Themes -->
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" id="light-dark-mode">
                                <i data-feather="moon" class="align-middle dark-mode"></i>
                                <i data-feather="sun" class="align-middle light-mode"></i>
                            </button>
                        </li>
                        <!-- User Dropdown -->
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/user-20.jpg" alt="user-image" class="rounded-circle" />
                                <span class="pro-user-name ms-1"><?= session()->get('nama') ?> <i class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="akun_saya" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                    <span>My Account</span>
                                </a>


                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="keluar_admin" class="dropdown-item notify-item">
                                    <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <div class="logo-box">
                        <a href="dashboard" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="24">
                            </span>
                        </a>
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark.png" alt="" height="24">
                            </span>
                        </a>
                    </div>

                    <ul id="side-menu">
                        <!-- sidebar admin -->
                        <?php if (session()->get('level') == 'admin'): ?>

                            <li class="menu-title mt-2">Dashborad</li>

                            <li class="<?= $title === "Dashboard"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/dashboard" class="tp-link <?= $title === "Dashboard"  ? 'active' : '' ?>">
                                    <i data-feather="bar-chart"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Lainnya</li>
                            <li class="<?= $title === "Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/daftaraduan" class="tp-link <?= $title === "Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="map-pin"></i>
                                    <span> Aduan </span>
                                </a>
                            </li>
                            <li class="<?= $title === "Instansi"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/instansi" class="tp-link <?= $title === "Instansi"  ? 'active' : '' ?>">
                                    <i data-feather="briefcase"></i>
                                    <span> Instansi </span>
                                </a>
                            </li>
                            <li class="<?= $title === "Kategori"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/kategori" class="tp-link <?= $title === "Kategori"  ? 'active' : '' ?>">
                                    <i data-feather="align-left"></i>
                                    <span> Kategori </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Pengguna</li>
                            <li class="<?= $title === "Masyarakat"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/pengguna-masyarakat" class="tp-link <?= $title === "Masyarakat"  ? 'active' : '' ?>">
                                    <i data-feather="users"></i>
                                    <span> Masyarakat </span>
                                </a>
                            </li>
                            <li class="<?= $title === "Operator"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/operator" class="tp-link <?= $title === "Operator"  ? 'active' : '' ?>">
                                    <i data-feather="user"></i>
                                    <span> Operator </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Laporan</li>
                            <li class="<?= $title === "Filter Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/laporan/filter_pengaduan" class="tp-link <?= $title === "Filter Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="archive"></i>
                                    <span>Filter Pengaduan </span>
                                </a>
                            </li>
                            <li class="<?= $title === "Laporan Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/laporan/pengaduan_laporan" class="tp-link <?= $title === "Laporan Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="airplay"></i>
                                    <span>Formulir Pengaduan </span>
                                </a>
                            </li>

                        <?php endif ?>
                        <!-- batas sidebar admin -->
                        <!-- sidebar Operator -->
                        <?php if (session()->get('level') == 'operator'): ?>
                            <li class="menu-title mt-2">Dashborad</li>

                            <li class="<?= $title === "Dashboard"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/dashboard" class="tp-link <?= $title === "Dashboard"  ? 'active' : '' ?>">
                                    <i data-feather="bar-chart"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Lainnya</li>
                            <li class="<?= $title === "Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/daftaraduanoperator" class="tp-link <?= $title === "Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="map-pin"></i>
                                    <span> Aduan </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Laporan</li>
                            <li class="<?= $title === "Filter Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/laporan/filter_pengaduan" class="tp-link <?= $title === "Filter Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="archive"></i>
                                    <span>Filter Pengaduan </span>
                                </a>
                            </li>
                            <li class="<?= $title === "Laporan Pengaduan"  ? ' menuitem-active' : '' ?>">
                                <a href="/admin/laporan/pengaduan_laporan" class="tp-link <?= $title === "Laporan Pengaduan"  ? 'active' : '' ?>">
                                    <i data-feather="users"></i>
                                    <span>Formulir Pengaduan </span>
                                </a>
                            </li>

                        <?php endif ?>
                        <!-- batas sidebar operator -->

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <?= $this->renderSection('content'); ?>
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy; <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">Informatika</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Vendor -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.4/dist/sweetalert2.all.min.js"></script>
    <!-- Datatables js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- dataTables.bootstrap5 -->
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <!-- buttons.bootstrap5 -->
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

    <!-- dataTable.responsive -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- dataTables.select -->
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

    <!-- Datatable Demo App Js -->
    <script src="assets/js/pages/datatable.init.js"></script>


    <!-- Apexcharts JS -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Boxplot Charts Init Js -->

    <!-- Widgets Init Js -->
    <script src="assets/js/pages/crm-dashboard.init.js"></script>

    <!-- App js-->
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const submitButton = document.getElementById('submitBtn');

            // Fungsi untuk memeriksa apakah password dan konfirmasi password cocok
            function checkPasswords() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password !== confirmPassword) {
                    submitButton.disabled = true; // Nonaktifkan tombol jika password tidak cocok
                } else {
                    submitButton.disabled = false; // Aktifkan tombol jika password cocok
                }
            }

            // Event listener untuk memeriksa password saat input berubah
            passwordInput.addEventListener('input', checkPasswords);
            confirmPasswordInput.addEventListener('input', checkPasswords);
        });

        // SCRIPT FILTERISASI LAPORAN
        $(document).ready(function() {
            $('#tahun, #bulan').on('change', function() {
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();

                // Pastikan parameter bulan atau tahun ada
                if (!bulan && !tahun) {
                    alert("Pilih bulan atau tahun terlebih dahulu.");
                    return;
                }

                $.ajax({
                    url: "<?= base_url('admin/laporan/filter'); ?>",
                    method: "GET",
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    },
                    success: function(response) {
                        console.log("Response: ", response); // Cek apakah data yang dikirim sudah benar
                        $('#filteredData').html(response); // Menampilkan data hasil filter
                    },
                    error: function(xhr, status, error) {
                        // Log error untuk debugging
                        console.log("Error Status: " + status);
                        console.log("Error Message: " + error);
                        console.log("Response Text: " + xhr.responseText);
                        alert("Terjadi kesalahan saat memuat data!");
                    }
                });

            });
        });



        <?php if (session()->getFlashdata('pesanloginerr')): ?>
            Swal.fire({
                icon: "error",
                title: "<?= session()->getFlashdata('pesanloginerr') ?>",
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('pesanlogin')): ?>
            Swal.fire({
                icon: "success",
                title: "<?= session()->getFlashdata('pesanlogin') ?>",
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('pesansimpan')): ?>
            Swal.fire({
                icon: "success",
                title: "<?= session()->getFlashdata('pesansimpan') ?>",
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        // hapus fungsi
        function hapusInstansi(id) {
            // SweetAlert2 Konfirmasi Hapus
            Swal.fire({
                title: 'Yakin ingin menghapus instansi ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan untuk menghapus data menggunakan AJAX
                    fetch(`<?= site_url('admin/hapus_instansi/') ?>` + id, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Instansi telah dihapus.',
                                    'success'
                                );
                                // Reload halaman atau hapus baris data dari tabel
                                location.reload(); // Atau hapus baris secara manual
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan, coba lagi nanti.',
                                'error'
                            );
                        });
                }
            });
        }

        function hapusKategori(id) {
            // SweetAlert2 Konfirmasi Hapus
            Swal.fire({
                title: 'Yakin ingin menghapus kategori ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan untuk menghapus data menggunakan AJAX
                    fetch(`<?= site_url('admin/hapus_kategori/') ?>` + id, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Kategori telah dihapus.',
                                    'success'
                                );
                                // Reload halaman atau hapus baris data dari tabel
                                location.reload(); // Atau hapus baris secara manual
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan, coba lagi nanti.',
                                'error'
                            );
                        });
                }
            });
        }

        function hapusDeskripsi(id) {
            // SweetAlert2 Konfirmasi Hapus
            Swal.fire({
                title: 'Yakin ingin menghapus deskripsi ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan untuk menghapus data menggunakan AJAX
                    fetch(`<?= site_url('admin/hapus_deskripsi/') ?>` + id, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Dihapus!',
                                    'deskripsi telah dihapus.',
                                    'success'
                                );
                                // Reload halaman atau hapus baris data dari tabel
                                location.reload(); // Atau hapus baris secara manual
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan, coba lagi nanti.',
                                'error'
                            );
                        });
                }
            });
        }
        //chart 
        // Mengambil data dari PHP
        var dataStatus = <?php echo json_encode($pengaduan_perstatus); ?>;

        // Menyiapkan data untuk chart
        var labels = [];
        var values = [];

        dataStatus.forEach(function(item) {
            labels.push(item.status);
            values.push(item.jumlah);
        });
        const ctx = document.getElementById('chartPengaduan');

        const chartPengaduan = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#0c7c66ff', '#11517cff', '#5d127aff',
                        '#79160bff', '#83450fff', '#bb9911ff'
                    ],
                    borderColor: [
                        '#0c7c66ff', '#11517cff', '#5d127aff',
                        '#79160bff', '#83450fff', '#bb9911ff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },

                }
            }
        });
        // FULLSIZE GAMBA
        function showFullImage() {
            // Menyembunyikan thumbnail dan menampilkan gambar penuh
            document.getElementById("myImage").style.display = "none";
            document.getElementById("fullImage").style.display = "block";
        }

        function showThumbnail() {
            // Menampilkan kembali thumbnail dan menyembunyikan gambar penuh
            document.getElementById("myImage").style.display = "block";
            document.getElementById("fullImage").style.display = "none";
        }

        // validasi upload file
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            // Mendapatkan elemen file input
            const fileInput = document.getElementById('file');
            const errorMessage = document.getElementById('error-message');

            // Mendapatkan file yang dipilih
            const file = fileInput.files[0];

            // Cek apakah file ada
            if (!file) {
                errorMessage.textContent = "Harap pilih file terlebih dahulu.";
                errorMessage.style.display = "block";
                event.preventDefault(); // Mencegah form dikirim
                return;
            }

            // Validasi ekstensi file
            const allowedExtensions = ['pdf', 'docx', 'doc', 'txt', 'odt'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                errorMessage.textContent = "Ekstensi file tidak valid. Harap unggah file dengan ekstensi .pdf, .docx, .doc, .txt, atau .odt.";
                errorMessage.style.display = "block";
                event.preventDefault(); // Mencegah form dikirim
                return;
            }

            // Validasi ukuran file (maksimal 5MB dan minimal 2MB)
            const maxSize = 2 * 1024 * 1024; // 5MB dalam bytes

            if (file.size > maxSize) {
                errorMessage.textContent = "Ukuran file terlalu besar. Harap unggah file yang lebih kecil dari 2MB.";
                errorMessage.style.display = "block";
                event.preventDefault(); // Mencegah form dikirim
                return;
            }

            // Jika validasi sukses, sembunyikan pesan kesalahan
            errorMessage.style.display = "none";
        });

        //cek password
    </script>


</body>

</html>