<?php if ($_SESSION['akses'] == ""): ?>
<?php
   header("location:../../index.php");
   exit(0);
   ?>
<?php endif; ?>

<?php if ($_SESSION['akses'] == "pelanggan"): ?>
<?php
   $baseFiles = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_SESSION[id_pelanggan]'");
   $baseFile = mysqli_fetch_array($baseFiles);
   ?>
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
   <div class="d-flex align-items-center justify-content-between">
      <a href="" role="button" class="d-flex align-items-center fs-5 fst-normal fw-semibold">
         <img src="<?= BASE_URL ?>assets/foto_icon/<?= $row['foto_icon'] ?>" width="100" height="100"
            alt="<?php echo $row['nama_website'] ?>">
         <div hidden><?php echo "$row[nama_website]"; ?></div>
      </a>
      <i class="bi bi-list toggle-sidebar-btn mx-5 mx-lg-5"></i>
   </div><!-- End Logo -->

   <nav class="header-nav ms-auto mx-3">
      <ul class="d-flex justify-content-center align-items-center mx-auto">
         <li class="nav-item dropdown pe-3">
            <a class="nav-link d-flex align-items-center pe-0" href="#" role="button" data-bs-toggle="dropdown"
               aria-controls="dropdown">
               <i class="fa fa-regular fa-calendar fa-2x"></i>
               <span class="d-none d-md-block dropdown-toggle ps-2"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
               <?php require_once("../ui/calendar.php") ?>
            </ul>
         </li>
         <li class="nav-item dropdown pe-4">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
               data-bs-toggle="dropdown" aria-controls="dropdown">
               <?php $dir = __DIR__ . "../../../../assets/default/user_logo.png"; ?>
               <?php if ($baseFile['gambar'] != $dir) { ?>
               <img src="../../../../assets/foto/<?= $baseFile['gambar'] ?>" class="img-responsive rounded-2"
                  style="width: 25px; max-width: 100%;" alt="<?= $baseFile['gambar'] ?>">
               <?php } else { ?>
               <img src="<?php echo $dir; ?>" class="img-responsive rounded-2" style="width: 25px; max-width: 100%;"
                  alt="user_logo.png">
               <?php } ?>
               <span class="d-none d-md-block dropdown-toggle ps-2"></span>
            </a>
            <!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
               <li class="dropdown-header">
                  <h4 class="fs-6 fw-normal text-start text-dark">
                     <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                        <div class="col-sm-4 col-md-4">
                           <label for="">nama lengkap</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <?php echo $baseFile['nama_pelanggan']; ?>
                        </div>
                     </div>
                  </h4>
                  <hr class="dropdown-divider">
                  <h4 class="fs-6 fw-normal text-start text-dark">
                     <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                        <div class="col-sm-4 col-md-4">
                           <label for="">email</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <?php echo $baseFile['email_pelanggan']; ?>
                        </div>
                     </div>
                  </h4>
                  <hr class="dropdown-divider">
                  <h4 class="fs-6 fw-normal text-start text-dark">
                     <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                        <div class="col-sm-4 col-md-4">
                           <label for="">telepon</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <?php echo $baseFile['telepon']; ?>
                        </div>
                     </div>
                  </h4>
                  <hr class="dropdown-divider">
                  <h4 class="fs-6 fw-normal text-start text-dark">
                     <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                        <div class="col-sm-4 col-md-4">
                           <label for="">Jabatan</label>
                        </div>
                        <div class="col-sm-1 col-md-1">:</div>
                        <div class="col-sm-6 col-md-6">
                           <?php echo $_SESSION['akses'] ?>
                        </div>
                     </div>
                  </h4>
                  <hr class="dropdown-divider my-2">
                  <div class="text-center">
                     <a href="?page=profile&id_pelanggan=<?= $_SESSION['id_pelanggan'] ?>"
                        class="btn btn-sm btn-info mx-2">
                        <i class="fas fa-fw fa-user fa-1x"></i>
                        Profile <?= $baseFile['nama_pelanggan'] ?>
                     </a>
                     <a href="?page=logout" onclick="return confirm('Apakah anda ingin keluar dari website ini ?')"
                        aria-current="page" class="btn btn-sm btn-danger mx-1">
                        <i class="fas fa-fw fa-sign-out-alt fa-1x"></i>
                        Log Out
                     </a>
                  </div>
               </li>
            </ul><!-- End Profile Dropdown Items -->
         </li><!-- End Profile Nav -->
      </ul>
   </nav><!-- End Icons Navigation -->
</header>
<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" style="background: rgba(100, 107, 107, 1);" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
            <i class="fas fa-tachometer-alt fa-1x"></i>
            <div class="fs-4 display-5 text-dark fw-normal">Dashboard</div>
         </a>
      </li>
      <div class="my-3 border border-top"></div>
      <li class="nav-item">
         <a href="?page=keranjang" aria-current="page" class="nav-link collapsed">
            <i class="fas fa-shopping-cart fa-1x"></i>
            <div class="fs-4 display-5 text-dark fw-normal">keranjang</div>
         </a>
      </li>
      <div class="my-3 border border-top"></div>
      <li class="nav-item">
         <a href="?page=riwayat" aria-current="page" class="nav-link collapsed">
            <i class="fas fa-history fa-1x"></i>
            <div class="fs-4 display-5 text-dark fw-normal">riwayat</div>
         </a>
      </li>
      <div class="my-3 border border-top"></div>
      <li class="nav-item">
         <a href="?page=checkout" aria-current="page" class="nav-link collapsed">
            <i class="fas fa-check fa-1x"></i>
            <div class="fs-4 display-5 text-dark fw-normal">Checkout</div>
         </a>
      </li>
   </ul>
</aside>
<!-- ======= Sidebar ======= -->
<main id="main" class="main">
   <section class="section dashboard">
      <div class="row">

         <!-- Left side columns -->
         <div class="col-lg-8">
            <div class="row">

            </div>

         </div><!-- End Right side columns -->

      </div>
   </section>
   <?php else: ?>
   <?php
      header("location:../../index.php");
      exit(0);
      ?>
   <?php endif; ?>