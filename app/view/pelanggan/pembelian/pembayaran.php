<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      //jika tdk ada session pelanggan (blm login)
      if (!isset($_SESSION["id_pelanggan"]) or empty($_SESSION["id_pelanggan"])) {
         echo "<script>alert('Silahkan Login Dahulu');</script>";
         echo "<script>location'?page=logout';</script>";
         exit();
      }

      //mendapatkan id_pembelian dri url
      $idpem = $_GET["id"];
      $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
      $detpem = $ambil->fetch_assoc();


      //mendapatkan id_pelanggan yg beli
      $id_pelanggan_beli = $detpem["id_pelanggan"];
      //mendapatkan id_pelanggan yg login
      $id_pelanggan_login = $_SESSION["id_pelanggan"];


      if ($id_pelanggan_login !== $id_pelanggan_beli) {
         echo "<script>alert('Data Bersifat Privasi!');</script>";
         echo "<script>location='riwayat.php';</script>";
         exit();
      }
      ?>
      <title><?php echo $judul; ?></title>
      <?php else: ?>
      <?php echo "<script>location = '?page=beranda';</script>"; ?>
      <?php die; ?>
      <?php endif; ?>
   </head>

   <body>
      <?php require_once("../ui/sidebar.php"); ?>
      <div class="panel panel-default bg-body-secondary rounded-3 p-4">
         <div class="panel-heading shadow-sm p-2">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
               <i class="fas fa-money-bill fa-fw fa-1x"></i>
               Data List Pembayaran
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                     Beranda
                  </a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=pembayaran&id=<?= $_GET['id'] ?>" aria-current="page" class="text-decoration-none">
                     Data List Pembayaran
                  </a>
               </li>
            </div>
         </div>
         <div class="panel-body">
            <section class="content">
               <div class="content-wrapper">
                  <h2 class="text-center">Konfirmasi Pembayaran</h2>
                  <p class="text-center">Kirim Bukti Pembayaran Disini</p>
                  <div class="d-flex justify-content-center align-items-center flex-wrap">
                     <div class="card col-sm-3">
                        <div class="card-header">
                           <div class="alert alert-info">Total Tagihan Anda Sebesar <strong>Rp.
                                 <?php echo number_format($detpem["total_pembelian"]) ?></strong>
                           </div>
                        </div>
                        <div class="card-body">
                           <form action="?aksi=bayar" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id_pembelian" value="<?= $_GET['id'] ?>">
                              <div class="form-group">
                                 <label>Nama Pengirim Bukti</label>
                                 <input type="text" class="form-control" name="nama">
                              </div>
                              <div class="form-group">
                                 <label>Bank</label>
                                 <input type="text" class="form-control" name="bank">
                              </div>
                              <div class="form-group">
                                 <label>Jumlah</label>
                                 <input type="text" class="form-control" name="jumlah">
                              </div>
                              <div class="form-group">
                                 <label>Foto Bukti</label>
                                 <input type="file" class="form-control" name="bukti">
                                 <p class="text-danger">Foto Bukti Harus JPG maksimal 2MB</p>
                              </div>
                              <button class="btn btn-primary" name="kirim">Kirim</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <?php require_once("../ui/footer.php") ?>