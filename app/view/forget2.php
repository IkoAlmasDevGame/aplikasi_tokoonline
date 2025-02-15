<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Forget Password 2</title>
      <?php require_once("../init.php"); ?>
      <?php require_once("../models/Setting_model.php"); ?>
      <?php require_once("../controllers/Setting.php"); ?>
      <?php require_once("../models/Pengguna_model.php"); ?>
      <?php require_once("../controllers/Pengguna.php"); ?>
      <?php $data = new controller\Setting($koneksi); ?>
      <?php $pengguna = new controller\Pengguna($koneksi); ?>
      <?php if (!isset($_GET['aksi'])) {
   } else {
      switch ($_GET['aksi']) {
         case 'forget-2':
            $pengguna->forgetpassword();
            break;

         default:
            # code...
            break;
      }
   } ?>
      <?php $result = $data->BySettingData(); ?>
      <?php foreach ($result as $website): ?>
      <title><?php echo $website['nama_website'] . " - Forget Password"; ?></title>
      <link rel="shortcut icon" href="<?= BASE_URL ?>assets/foto_icon/<?= $website['foto_icon'] ?>" type="image/x-icon">
      <?php endforeach; ?>
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
      <?php
   if (!isset($_GET['email'])):
      echo "<script>alert('Email tidak ditemukan.');</script>";
      echo "<script>document.location.href = 'forget.php'</script>";
   endif;

   $email_pelanggan = $_GET['email'];
   // Mengambil data pembayaran berdasarkan ID pembelian
   $stmt = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email_pelanggan'");
   $isi = $stmt->fetch_assoc();

   if (!$isi) {
      echo "<script>alert('Data Email tidak ditemukan untuk pelanggan.')</script>";
      $halaman = URL_BASE . "forget.php";
      echo "<script>document.location.href = '$halaman';</script>";
      die;
   }
   ?>
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
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation">
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
                  <?php echo $website['nama_website'] . " - Forget Password"; ?>
               </h4>
            </div>
            <div class="card-body my-2">
               <form action="?aksi=forget-2" class="form-group" method="post" aria-required="TRUE">
                  <input type="hidden" name="id_pelanggan" value="<?= $isi['id_pelanggan'] ?>">
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                           <label for="old_password" class="label label-default">Old
                              Password</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <input type="password" placeholder="masukkan password lama ..." class="form-control"
                              name="old_password" value="" required id="old_password" aria-required="TRUE">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                           <label for="new_password" class="label label-default">Password</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <input type="password" placeholder="masukkan password baru ..." class="form-control"
                              name="new_password" value="" required id="new_password" aria-required="TRUE">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                           <label for="new_password_verify" class="label label-default">Password
                              Verify</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <input type="password" placeholder="ulangi password baru anda ..." class="form-control"
                              name="new_password_verify" value="" required id="new_password_verify"
                              aria-required="TRUE">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-1">
                     <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">
                           Done Forget
                        </button>
                     </div>
                  </div>
               </form>
               <div class="text-center">
                  <a href="index.php" role="button" aria-current="page" class="text-decoration-underline text-primary">
                     Tidak Lupa Password
                  </a>
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