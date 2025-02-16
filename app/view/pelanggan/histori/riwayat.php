<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      if (!isset($_SESSION["id_pelanggan"]) or empty($_SESSION["id_pelanggan"])) {
         echo "<script>alert('Silahkan Login Dahulu');</script>";
         echo "<script>location='../../index.php';</script>";
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
            Data List Riwayat
         </h4>
         <div class="d-flex justify-content-end align-items-end flex-wrap">
            <li class="breadcrumb breadcrumb-item">
               <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                  Beranda
               </a>
            </li>
            <li class="breadcrumb breadcrumb-item">
               <a href="?page=riwayat" aria-current="page" class="text-decoration-none">
                  Data List Riwayat
               </a>
            </li>
         </div>
      </div>
      <div class="panel-body">
         <section class="content">
            <div class="content-wrapper">
               <div class="container">
                  <h3>Riwayat Belanja
                     <?php echo "[" . $_SESSION["id_pelanggan"] . " - " . $_SESSION["nama_pelanggan"] . "]" ?>
                  </h3>
                  <div class="table-responsive">
                     <div class="container">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center fw-normal">No</th>
                                 <th class="text-center fw-normal">Tanggal</th>
                                 <th class="text-center fw-normal">Status</th>
                                 <th class="text-center fw-normal">Total</th>
                                 <th class="text-center fw-normal">Opsi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $nomor = 1;
                              //mendapatkan id_pelanggan yg login
                              $id_pelanggan = $_SESSION["id_pelanggan"];

                              $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
                              while ($pecah = $ambil->fetch_assoc()) {
                              ?>

                                 <tr>
                                    <td class="text-center fw-normal"><?php echo $nomor; ?></td>
                                    <td class="text-center fw-normal"><?php echo $pecah["tanggal_pembelian"] ?></td>
                                    <td class="text-center fw-normal">
                                       <?php echo $pecah["status_pembelian"] ?>
                                       <br>
                                       <?php if (!empty($pecah['resi_pengiriman'])): ?>
                                          Resi : <?php echo $pecah['resi_pengiriman']; ?>
                                       <?php endif ?>
                                    </td>
                                    <td class="text-center fw-normal">Rp.
                                       <?php echo number_format($pecah["total_pembelian"]) ?></td>
                                    <td class="text-center fw-normal">
                                       <a href="?page=nota&id=<?php echo $pecah["id_pembelian"] ?>"
                                          class="btn btn-info">Nota</a>

                                       <?php if ($pecah['status_pembelian'] == "pending"): ?>

                                          <a href="?page=pembayaran&id=<?php echo $pecah["id_pembelian"]; ?>"
                                             class="btn btn-success">
                                             Input Pembayaran
                                          </a>
                                       <?php else: ?>
                                          <a href="?page=lihat_pembayaran&id=<?php echo $pecah["id_pembelian"]; ?>"
                                             class="btn btn-warning">
                                             Lihat Pembayaran
                                          </a>
                                       <?php endif ?>

                                    </td>
                                 </tr>
                                 <?php $nomor++; ?>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <?php require_once("../ui/footer.php"); ?>