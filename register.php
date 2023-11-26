<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once 'koneksi.php';
?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-admin/assets-path="admin/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Testing</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="admin/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="admin/assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                        <span class="app-brand-text text-body fw-bolder fs-5">Register</span>
                        </div>
                        <div class="app-brand justify-content-center">
                        <span class="app-brand-text text-body fw-bolder fs-5"> Toko Sukses Bersama </span>
                        </div>
                        <!-- /Logo -->
                        <form id="formAuthentication" class="mb-3" action="" method="POST">
                            <div class="mb-3">
                                <!-- <label for="nama" class="form-label">Nama</label> -->
                                <input type="text" class="form-control" id="nama" name="nama" autofocus required placeholder="Masukan nama" />
                            </div>
                            <div class="mb-3">
                                <!-- <label for="email" class="form-label">Email</label> -->
                                <input type="text" class="form-control" id="email" name="email" autofocus required placeholder="Masukan email" />
                            </div>
                            <div class="mb-3">
                                <!-- <label for="no_hp" class="form-label">No HP</label> -->
                                <input type="text" class="form-control" id="no_hp" name="no_hp" autofocus required placeholder="Masukan nomor hp" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <!-- <label class="form-label" for="password">Password</label> -->
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" required placeholder="Masukan password" aria-describedby="password" />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <!-- <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label> -->
                                <div class="input-group input-group-merge">
                                    <input type="password" id="konfirmasi_password" class="form-control" name="konfirmasi_password" required placeholder="Masukan konfirmasi password" aria-describedby="password" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-warning d-grid w-100" type="submit" id="register" name="register" disabled>Register</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <a href="login.php" class="text-warning">
                                <span>Sudah Punya akun</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['register'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        if (strlen($password) >= 5) {
            if ($password == $konfirmasi_password) {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $query  = "INSERT INTO user (nama, email, no_hp, password) VALUES ('$nama', '$email', '$no_hp', '$passwordHash')";
                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                } else {
                    echo "<script>alert('Akun berhasil dibuat!');window.location='login.php';</script>";
                }
            } else {
                echo "<script>alert('Konfirmasi password tidak sama!'); window.location.href='register.php';</script>";
            }
        } else {
            echo "<script>alert('Password harus memiliki minimal 5 karakter!'); window.location.href='register.php';</script>";
        }
    }
    ?>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js admin/assets/vendor/js/core.js -->
    <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>
    <script src="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="admin/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        $(document).ready(function() {
            $('#nama, #email, #no_hp, #password, #konfirmasi_password').keyup(function() {
                if ($('#nama').val() != '' && $('#email').val() != '' && $('#no_hp').val() != '' && $('#password').val() != '' && $('#konfirmasi_password').val() != '') {
                    $('#register').removeAttr('disabled');
                } else {
                    $('#register').attr('disabled', true);
                }
            });
        });
    </script>
</body>

</html>