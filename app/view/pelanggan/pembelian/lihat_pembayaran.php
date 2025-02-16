<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      $id_pembelian = $_GET["id"];

      $ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
      WHERE pembelian.id_pembelian='$id_pembelian'");
      $detbay = $ambil->fetch_assoc();

      //jika blm ada data pembayaran
      if (empty($detbay)) {
         echo "<script>alert('belum ada data pembayaran')</script>";
         echo "<script>location='riwayat.php';</script>";
         exit();
      }

      if ($_SESSION["id_pelanggan"] !== $detbay["id_pelanggan"]) {
         echo "<script>alert('data ini bersifat privasi!')</script>";
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
               <i class="fas fa-history fa-fw fa-1x"></i>
               Data List Pembayaran
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                     Beranda
                  </a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=lihat_pembayaran&id=<?= $_GET['id'] ?>" aria-current="page"
                     class="text-decoration-none">
                     Data List Pembayaran
                  </a>
               </li>
            </div>
         </div>
         <div class="panel-body">
            <section class="content">
               <div class="content-wrapper">
                  <div class="container">
                     <h3>Lihat Pembayaran</h3>
                     <div class="row">
                        <div class="col-md-6">
                           <table class="table">
                              <tr>
                                 <th>Nama</th>
                                 <td><?php echo $detbay["nama"] ?></td>
                              </tr>
                              <tr>
                                 <th>Bank</th>
                                 <td><?php echo $detbay["bank"] ?></td>
                              </tr>
                              <tr>
                                 <th>Tanggal</th>
                                 <td><?php echo $detbay["tanggal"]; ?></td>
                              </tr>
                              <tr>
                                 <th>Jumlah</th>
                                 <td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
                              </tr>
                           </table>
                        </div>
                        <div class="col-md-6">
                           <img src="<?= BASE_URL ?>assets/bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt=""
                              class="img-responsive">
                           <br>
                           <small><?php echo $detbay['bank'] ?></small>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <?php require_once("../ui/footer.php") ?>