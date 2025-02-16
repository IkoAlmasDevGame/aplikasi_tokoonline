<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      //mendapatkan id_produk dari url
      $id_produk = $_GET["id"];

      //query ambil data
      $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
      $detail = $ambil->fetch_assoc();
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
            <i class="fas fa-shopping-cart fa-fw fa-1x"></i>
            Data Detail Produk
         </h4>
         <div class="d-flex justify-content-end align-items-end flex-wrap">
            <li class="breadcrumb breadcrumb-item">
               <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                  Beranda
               </a>
            </li>
            <li class="breadcrumb breadcrumb-item">
               <a href="?page=detail&id=<?= $_GET['id'] ?>" aria-current="page" class="text-decoration-none">
                  Data Detail Produk
               </a>
            </li>
         </div>
      </div>
      <div class="panel-body">
         <section class="content">
            <div class="content-wrapper">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <img src="<?= BASE_URL ?>/assets/foto_produk/<?php echo $detail["foto_produk"] ?>" alt=""
                           class="img-responsive">
                     </div>
                     <div class="col-md-6">
                        <h2><?php echo $detail["nama_produk"] ?></h2>
                        <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                        <h5>Stok Produk: <?php echo $detail['stok_produk'] ?></h5>
                        <form method="post">
                           <div class="form-group">
                              <div class="input-group">
                                 <input type="number" min="1" class="form-control" name="jumlah"
                                    max="<?php echo $detail['stok_produk'] ?>">
                                 <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">Beli</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <?php
                        //jika ada tombol beli
                        if (isset($_POST["beli"])) {
                           //mendapatkan jumlah yang diinput
                           $jumlah = $_POST["jumlah"];
                           //masukan di keranjang belanja
                           $_SESSION["keranjang"][$id_produk] = $jumlah;

                           echo "<script>alert('Produk Telah Masuk ke Keranjang Belanja');</script>";
                           echo "<script>location='?page=keranjang';</script>";
                        }
                        ?>
                        <p>
                           <?php echo $detail["deskripsi_produk"]; ?>
                        <p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <?php require_once("../ui/footer.php") ?>