<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("../init.php"); ?>
    <?php require_once("../models/Setting_model.php"); ?>
    <?php require_once("../controllers/Setting.php"); ?>
    <?php $data = new controller\Setting($koneksi); ?>
    <?php $result = $data->BySettingData(); ?>
    <?php foreach ($result as $website): ?>
        <title><?php echo $website['nama_website'] . " - Home"; ?></title>
        <link rel="shortcut icon" href="<?= BASE_URL ?>assets/foto_icon/<?= $website['foto_icon'] ?>"
            type="image/x-icon">
    <?php endforeach; ?>
    <!-- Authentication Start -->
    <?php require_once("../models/Authentication_model.php"); ?>
    <?php require_once("../controllers/Authentication.php"); ?>
    <?php $auth = new controller\Authentication($koneksi); ?>
    <?php
    if (!isset($_GET['aksi'])):
    else:
        switch ($_GET['aksi']) {
            case 'login':
                $auth->Login();
                break;

            default:
                require_once("../controllers/Authentication.php");
                break;
        }
    endif;
    ?>
    <!-- Authentication Finish -->
    <!-- Style CSS start -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Style CSS Finish -->
    <!-- Javascript Start -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
    </script>
    <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Javascript Finish -->
</head>

<body onload="startTime()" class="bg-secondary">
    <header class="header">
        <nav class="navbar navbar-expand-lg position-sticky bg-body-tertiary">
            <div class="header-nav container-fluid">
                <a href="<?= URL_BASE ?>/index<?= ".php" ?>" class="navbar-brand">
                    <img src="<?= BASE_URL ?>assets/foto_icon/<?= $website['foto_icon'] ?>" width="60" height="60"
                        alt="<?php echo $website['nama_website'] ?>">
                    <?php echo $website['nama_website'] ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-2">
                        <li class="nav-item btn btn-outline-danger mx-1">
                            <a href="<?= URL_BASE ?>/index<?= ".php" ?>" aria-current="page" class="nav-link">
                                <div class="fs-5 fw-normal fst-normal display-5
                                    d-flex align-items-center justify-content-center">
                                    <i class="fa fa-house-user fa-1x mx-1"></i>
                                    HOME
                                </div>
                            </a>
                        </li>
                        <li class="nav-item btn btn-outline-info mx-1">
                            <a href="<?= URL_BASE ?>/regist<?= ".php" ?>" aria-current="page" class="nav-link">
                                <div class="fs-5 fw-normal fst-normal display-5 
                                    d-flex align-items-center justify-content-center">
                                    <i class="fa fa-registered fa-1x mx-1"></i>
                                    REGISTER
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="d-flex justify-content-center align-items-center flex-wrap 
            mt-5 ms-0 me-0 mb-0 pt-5 ps-0 pe-0 pb-0">
        <div class="card col-sm-4 shadow mb-3">
            <div class="card-header py-3">
                <h4 class="card-title text-center">
                    <img class='img-responsive' src='<?= BASE_URL ?>assets/foto_icon/<?= $website['foto_icon'] ?>'
                        width="90" height="90">
                    <?php echo $website['nama_website'] . " - Login"; ?>
                </h4>
            </div>
            <div class="card-body my-2">
                <form action="?aksi=login" class="form-group" method="post" aria-required="TRUE">
                    <div class="form-inline my-2">
                        <div class="row justify-content-center align-items-center flex-wrap">
                            <div class="form-label col-sm col-sm-4">
                                <label for="">email</label>
                            </div>
                            <div class="col-sm col-sm-8">
                                <input type="email" name="email" class="form-control"
                                    placeholder="masukkan email anda ..." id="">
                            </div>
                        </div>
                    </div>
                    <div class="form-inline my-2">
                        <div class="row justify-content-center align-items-center flex-wrap">
                            <div class="form-label col-sm col-sm-4">
                                <label for="">password</label>
                            </div>
                            <div class="col-sm col-sm-8">
                                <input type="password" name="password" class="form-control"
                                    placeholder="masukkan kata sandi anda ..." id="">
                            </div>
                        </div>
                    </div>
                    <div class="form-inline my-2">
                        <div class="row justify-content-start align-items-start flex-wrap">
                            <div class="form-label col-sm col-sm-4">
                                <label for="">Akses Login</label>
                            </div>
                            <div class="col-sm col-sm-5">
                                <select name="akses" class="form-select" id="">
                                    <option value="">Pilih Akses Login</option>
                                    <option value="admin">Admin</option>
                                    <option value="pelanggan">Pelanggan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline my-2">
                        <div class="row justify-content-start align-items-start flex-wrap">
                            <div class="form-label col-sm-4 col-md-4">
                                <input type="hidden" name="angka1" value="<?= $angka1 ?>">
                                <input type="hidden" name="angka2" value="<?= $angka2 ?>">
                                <label for="" class="label label-default">
                                    <?php echo $angka1 . " + " . $angka2; ?> = ?</label>
                            </div>
                            <div class="col-sm-5 col-md-5">
                                <input type="number" class="form-control" aria-required="TRUE" name="hasil"
                                    placeholder="Capthca" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline my-1">
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary" name="submit">
                                <i class="fa fa-sign-in-alt fa-1x"></i>
                                SIGN IN
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-eraser fa-1x"></i>
                                HAPUS SEMUA
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <div class="display-4 fs-5 text-wrap fst-normal fw-normal my-2">
                        <?php echo "&copy " . $website['nama_website'] . ", " . date('Y'); ?>
                    </div>
                    <div class="display-4 fs-5 text-wrap fst-normal fw-normal my-2">
                        <div id="days"></div>
                    </div>
                    <div class="display-4 fs-5 text-wrap fst-normal fw-normal my-2">
                        <div id="clock"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function startTime() {
            var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            var month = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september",
                "oktober",
                "november", "desember"
            ];
            var today = new Date();
            var h = today.getHours();
            var tahun = today.getFullYear();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('days').innerHTML =
                "Tanggal : " + day[today.getDay()] + ", " + today.getDate() + " " + month[today.getMonth()] +
                " " + tahun;
            document.getElementById('clock').innerHTML =
                "Waktu Sekarang : " +
                h + " : " + m + " : " + s + "";
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    </script>
</body>

</html>