<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?> || Ruang Suara</title>
    <base href="<?= base_url('assets-home'); ?>">
    <link rel="icon" type="image/x-icon" href="./assets-home/assets/favicon.ico" />

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="./assets-home/vendors/jquery-ui/jquery-ui.min.css" />
    <link rel="stylesheet" href="./assets-home/vendors/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets-home/vendors/fa/css/all.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets-home/dist/css/style.css" />
    <style>
        .header-background {
            position: absolute;
            background-color: #f8f9fd;
            width: 100%;
            height: 60rem;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .hidden {
            display: none;
        }

        .timeline-wrapper {
            position: relative;
            border-left: 2px solid rgba(49, 49, 49, 0.064);
            padding-left: 0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: flex-start;
        }

        .timeline-marker {
            position: absolute;
            left: -6px;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.05);
        }

        .timeline-content {
            margin-left: 1rem;
            flex: 1;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .4rem;
            flex-wrap: nowrap;
            gap: 0.5rem;
        }

        .timeline-status {
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 8px;
            text-transform: capitalize;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .timeline-date {
            font-size: 12px;
            color: #aaa;
            font-weight: 400;
        }

        @media (max-width: 768px) {
            .timeline-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
            }

            .timeline-status {
                font-size: 13px;
                padding: 4px 12px;
                border-radius: 6px;
            }

            .timeline-date {
                margin-top: 4px;
                font-size: 11.5px;
                color: #9a9a9a;
            }

            .timeline-content p {
                font-size: 14px;
                margin-top: 6px;
                line-height: 1.6;
            }
        }

        #fullImage {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            object-fit: contain;
        }

        /* Gaya untuk loading container */
        .loading-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            z-index: 9999;
        }

        /* Gaya untuk bar */
        .bar {
            width: 30px;
            height: 10px;
            margin: 5px;
            background-color: #ffffffff;
            animation: grow 0.8s infinite alternate;
        }

        /* Setiap bar akan memiliki delay yang berbeda */
        .bar:nth-child(1) {
            animation-delay: 0s;
        }

        .bar:nth-child(2) {
            animation-delay: 0.2s;
        }

        .bar:nth-child(3) {
            animation-delay: 0.4s;
        }

        /* Animasi untuk bar yang tumbuh */
        @keyframes grow {
            0% {
                height: 10px;
            }

            100% {
                height: 30px;
            }
        }

        /* Gaya untuk teks loading */
        .loading-container p {
            font-size: 16px;
            color: #ffffffff;
            margin-top: 10px;
        }
    </style>
</head>

<body class="page__homepage">
    <nav class="navbar navbar-expand-xl bg-ghost-white">
        <div class="container-xxl justify-content-md-start">
            <a class="navbar-brand" href="/">
                <img src="./assets-home/assets/logo.svg" alt="" />
            </a>
            <!-- /.navbar-brand -->

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <!-- /.navbar-toggler-mobile -->

            <!-- /.btn-login and btn-signup mobile -->

            <div class="collapse navbar-collapse" id="navbarContent">
                <div
                    class="d-grid d-xl-flex align-items-xl-center pb-15 pb-xl-0 w-100 gap-20 gap-xl-0">
                    <ul class="navbar-nav mx-xl-auto order-2 order-xl-1">
                        <li class="nav-item">
                            <a class="nav-link <?= $title === "Home"  ? 'active' : '' ?>" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $title === "Daftar Pengaduan"  ? 'active' : '' ?>" href="aduan_masyarakat">Aduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $title === "Buat Aduan"  ? 'active' : '' ?>" href="/masyarakat/buataduan">Buat Aduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $title === "Panduan"  ? 'active' : '' ?>" href="panduanview">Tentang Kami</a>
                        </li>
                    </ul>
                    <!-- /.navbar-nav -->

                    <!-- /.form-search -->

                    <div class="d-grid d-md-none d-xl-flex gap-15 gap-xl-0 order-3">
                        <?php if (session()->get('logged_in_mas') != true) : ?>
                            <a
                                class="btn btn-alice-blue text-dark fw-semiBold py-12 px-xl-34 ms-xl-12 rounded-pill"
                                href="masuk_masyarakat"
                                role="button">Log In</a>
                            <a
                                class="btn btn-primary fw-semiBold py-12 px-xl-43 ms-xl-12 rounded-pill"
                                href="daftar_masyarakat"
                                role="button">Sign Up</a>
                        <?php endif ?>
                        <?php if (session()->get('logged_in_mas') == true) : ?>
                            <a
                                class="btn btn-primary fw-semiBold py-12 px-xl-43 ms-xl-12 rounded-pill"
                                href="/masyarakat/logout_masyarakat"
                                role="button">Logout</a>
                            <a
                                class="btn btn-primary fw-semiBold py-12 px-xl-43 ms-xl-12 rounded-pill"
                                href="/masyarakat/profile"
                                role="button"><i class="fas fa-user"></i>Profil</a>
                        <?php endif ?>
                    </div>
                    <!-- /.btn-login and btn-sign-up desktop -->
                </div>
            </div>
        </div>
    </nav>
    <!-- = /. Navbar Section = -->
    <?= $this->renderSection('content-home'); ?>
    <!-- = /. Main Section = -->

    <footer class="footer bg-black">
        <div class="container-xxl">
            <div class="row py-25 py-lg-43 py-xl-80 align-items-md-center">
                <div class="col-12 col-md-6">
                    <h2 class="heading-section-2 text-white mb-0">
                        Laporkan Dengan Mudah, Dapatkan Solusi Lebih Cepat Hanya di Ruang Suara
                    </h2>
                    <!-- /.newsletter-heading -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-md-6 col-lg-5 offset-lg-1 mt-25 mt-md-0">

                    <!-- /.newsletter-form -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.container -->

        <div
            class="border border-arsenic border-end-0 border-bottom-0 border-start-0">
            <div
                class="container-xxl d-grid d-lg-flex gap-12 gap-xl-0 justify-content-lg-between py-25">
                <div class="fs-14 text-white text-center">
                    Pengaduan Masyarakat Landing Website - © 2025 All Rights Reserved
                </div>

                <div class="fs-14 text-white text-center">
                    Made with ♥ by Informatika
                </div>
            </div>
        </div>
    </footer>
    <!-- = /. Footer Section = -->

    <!-- Bootstrap JS -->
    <script src="./assets-home/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.4/dist/sweetalert2.all.min.js"></script>

    <!-- Vendors -->
    <script src="./assets-home/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="./assets-home/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="./assets-home/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="./assets-home/vendors/fslightbox/fslightbox.js"></script>
    <script src="./assets-home/vendors/svg-inject/dist/svg-inject.min.js"></script>

    <!-- Template Function -->
    <script src="./assets-home/dist/js/theme.js"></script>
    <script src="./assets-home/vendors/fa/js/all.js"></script>
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
        $(document).ready(function() {
            let timeout; // Variabel untuk debounce agar pencarian tidak terlalu sering

            // Event listener untuk kolom pencarian
            $('#search').on('input', function() {
                clearTimeout(timeout); // Hapus timeout sebelumnya
                timeout = setTimeout(function() {
                    var search = $('#search').val(); // Ambil nilai pencarian
                    var instansi = $('#instansi').val(); // Ambil instansi
                    var kategori = $('#kategori').val(); // Ambil kategori

                    // Kirim data pencarian menggunakan AJAX
                    $.ajax({
                        url: '/Pengaduan/search', // Endpoint controller
                        type: 'GET',
                        data: {
                            search: search,
                            instansi: instansi,
                            kategori: kategori
                        },
                        beforeSend: function() {
                            // Menampilkan spinner atau indikator loading
                            $('#loading').show();
                        },
                        success: function(response) {
                            // Update bagian tabel dengan hasil pencarian
                            $('#tabelAduan').html(response);
                        },
                        error: function() {
                            alert('Error occurred while searching');
                        },
                        complete: function() {
                            // Sembunyikan spinner setelah pencarian selesai
                            $('#loading').hide();
                        }
                    });
                }, 500); // Tunggu 500ms setelah input terakhir
            });

            // Event listener untuk dropdown Instansi
            $('#instansi').on('change', function() {
                var search = $('#search').val(); // Ambil nilai pencarian
                var instansi = $('#instansi').val(); // Ambil instansi
                var kategori = $('#kategori').val(); // Ambil kategori

                // Kirim data pencarian menggunakan AJAX
                $.ajax({
                    url: '/Pengaduan/search', // Endpoint controller
                    type: 'GET',
                    data: {
                        search: search,
                        instansi: instansi,
                        kategori: kategori
                    },
                    beforeSend: function() {
                        $('#loading').show(); // Menampilkan spinner
                    },
                    success: function(response) {
                        $('#tabelAduan').html(response); // Update hasil pencarian
                    },
                    error: function() {
                        alert('Error occurred while searching');
                    },
                    complete: function() {
                        $('#loading').hide(); // Sembunyikan spinner setelah selesai
                    }
                });
            });

            // Event listener untuk dropdown Kategori
            $('#kategori').on('change', function() {
                var search = $('#search').val(); // Ambil nilai pencarian
                var instansi = $('#instansi').val(); // Ambil instansi
                var kategori = $('#kategori').val(); // Ambil kategori

                // Kirim data pencarian menggunakan AJAX
                $.ajax({
                    url: '/Pengaduan/search', // Endpoint controller
                    type: 'GET',
                    data: {
                        search: search,
                        instansi: instansi,
                        kategori: kategori
                    },
                    beforeSend: function() {
                        $('#loading').show(); // Menampilkan spinner
                    },
                    success: function(response) {
                        $('#tabelAduan').html(response); // Update hasil pencarian
                    },
                    error: function() {
                        alert('Error occurred while searching');
                    },
                    complete: function() {
                        $('#loading').hide(); // Sembunyikan spinner setelah selesai
                    }
                });
            });
        });
        // $(document).ready(function() {
        //     // Event listener untuk form pencarian
        //     $('#searchForm').on('submit', function(e) {
        //         e.preventDefault(); // Mencegah form dari submit biasa

        //         // Ambil data dari form
        //         var search = $('#search').val();
        //         var instansi = $('#instansi').val();
        //         var kategori = $('#kategori').val();

        //         // Kirim data pencarian menggunakan AJAX
        //         $.ajax({
        //             url: '/Pengaduan/search', // Endpoint di controller
        //             type: 'GET',
        //             data: {
        //                 search: search,
        //                 instansi: instansi,
        //                 kategori: kategori
        //             },
        //             success: function(response) {
        //                 // Update bagian tabel dengan hasil pencarian
        //                 $('#tabelAduan').html(response); // Misalnya id tabel adalah 'tabelAduan'
        //             },
        //             error: function() {
        //                 alert('Error occurred while searching');
        //             }
        //         });
        //     });
        // });

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                title: "Pesan Masuk",
                html: "<?= session()->getFlashdata('error') ?>",
                icon: "error"
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('errorfile')): ?>
            Swal.fire({
                title: "Pesan Masuk",
                html: "<?= session()->getFlashdata('errorfile') ?>",
                icon: "error"
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('pesanlogin')): ?>
            Swal.fire({
                title: "Pesan Masuk",
                html: "<?= session()->getFlashdata('pesanlogin') ?>",
                icon: "success"
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('pesan_aduan')): ?>
            Swal.fire({
                title: "Pesan Masuk",
                html: "<?= session()->getFlashdata('pesan_aduan') ?>",
                icon: "success"
            });
        <?php endif; ?>


        const fileInput = document.getElementById('fileInput');
        const uploadZone = document.getElementById('uploadZone');
        const uploadedFile = document.getElementById('uploadedFile');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const deleteFile = document.getElementById('deleteFile');


        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                uploadZone.style.display = 'none';
                uploadedFile.style.display = 'flex';
            }
        });


        deleteFile.addEventListener('click', function() {
            fileInput.value = '';
            uploadedFile.style.display = 'none';
            uploadZone.style.display = 'flex';
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
    </script>
    <script>
        const checkboxes = document.querySelectorAll('input[name="tipeaduan"]');
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    checkboxes.forEach((cb) => {
                        if (cb !== checkbox) cb.checked = false;
                    });
                }
            });
        });

        // MUNCUL FEEDBACK
        // Ambil elemen tombol dan form feedback
        const feedbackButton = document.getElementById('feedbackButton');
        const feedbackForm = document.getElementById('feedbackForm');
        const closeButton = document.getElementById('closeButton');

        // Event listener untuk menampilkan form feedback saat tombol diklik
        feedbackButton.addEventListener('click', () => {
            feedbackForm.style.display = 'block'; // Menampilkan form
        });

        // Event listener untuk menutup form feedback
        closeButton.addEventListener('click', () => {
            feedbackForm.style.display = 'none'; // Menyembunyikan form
        });
    </script>
</body>

</html>