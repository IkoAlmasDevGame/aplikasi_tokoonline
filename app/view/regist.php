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
      <title><?php echo $website['nama_website'] . " - Register"; ?></title>
      <link rel="shortcut icon" href="<?= BASE_URL ?>assets/foto_icon/<?= $website['foto_icon'] ?>" type="image/x-icon">
      <?php endforeach; ?>
      <!-- Data Pendaftaran -->
      <?php require_once("../models/Pengguna_model.php"); ?>
      <?php require_once("../controllers/Pengguna.php"); ?>
      <?php $files = new controller\Pengguna($koneksi); ?>
      <?php if (!isset($_GET['aksi'])): ?>
      <?php else: ?>
      <?php switch ($_GET['aksi']) {
            case 'daftar':
                $files->Daftar();
                break;

            default:
                require_once("../controllers/Pengguna.php");
                break;
        }
        ?>
      <?php endif; ?>
      <!-- Data Pendaftaran -->
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
               <a href="<?= URL_BASE ?>regist<?= ".php" ?>" class="navbar-brand">
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
                        <a href="<?= URL_BASE ?>index<?= ".php" ?>" aria-current="page" class="nav-link">
                           <div class="fs-5 fw-normal fst-normal display-5
                                    d-flex align-items-center justify-content-center">
                              <i class="fa fa-house-user fa-1x mx-1"></i>
                              HOME
                           </div>
                        </a>
                     </li>
                     <li class="nav-item btn btn-outline-info mx-1">
                        <a href="<?= URL_BASE ?>regist<?= ".php" ?>" aria-current="page" class="nav-link">
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
                  <?php echo $website['nama_website'] . " - Register"; ?>
               </h4>
            </div>
            <div class="card-body my-2">
               <form action="?aksi=daftar" class="form-group" method="post" enctype="multipart/form-data">
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm col-sm-4">
                           <label for="">email</label>
                        </div>
                        <div class="col-sm col-sm-8">
                           <input type="email" name="email_pelanggan" maxlength="200" class="form-control"
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
                           <input type="password" name="password" maxlength="200" class="form-control"
                              placeholder="masukkan kata sandi anda ..." id="">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm col-sm-4">
                           <label for="">nama pengguna</label>
                        </div>
                        <div class="col-sm col-sm-8">
                           <input type="text" name="nama_pelanggan" maxlength="200" class="form-control"
                              placeholder="masukkan nama pengguna ..." id="">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-center flex-wrap">
                        <div class="form-label col-sm col-sm-4">
                           <label for="">telepon pengguna</label>
                        </div>
                        <div class="col-sm col-sm-8">
                           <input type="text" name="telepon" maxlength="16" class="form-control"
                              placeholder="masukkan nomor telepon anda ..." id="">
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm col-sm-4">
                           <label for="">alamat pengguna</label>
                        </div>
                        <div class="col-sm col-sm-8">
                           <textarea name="alamat_pelanggan" id="" maxlength="255"
                              placeholder="masukkan alamat rumah anda disini ..." class="form-control"
                              cols="30"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-2">
                     <div class="row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm col-sm-4">
                           <label for="">Foto pengguna</label>
                        </div>
                        <div class="col-sm col-sm-8">
                           <div class="form-icon img-thumbnail w-25">
                              <img id="preview" src="<?= BASE_URL ?>assets/default/user_logo.png" alt="" width="80"
                                 height="80" class="img-rounded img-fluid">
                           </div>
                           <div class="form-control my-3">
                              <input type="file" name="gambar" accept="image/*" class="form-control-file"
                                 onchange="previewImage(this)" aria-required="true">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-inline my-1">
                     <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary" name="submit">
                           <i class="fa fa-save fa-1x"></i>
                           SIMPAN DATA
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

      function previewImage(input) {
         const file = input.files[0];
         if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.onload = function() {
               URL.revokeObjectURL(preview.src); // Free memory
            };
         }
      }
      </script>
   </body>

</html>