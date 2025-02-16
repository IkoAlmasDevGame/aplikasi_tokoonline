<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
         echo "<script>alert('Tidak Ada Produk di Keranjang. Silahkan Pilih Produk')</script>";
         echo "<script>location = '?page=beranda';</script>";
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
               <i class="fas fa-shopping-cart fa-fw fa-1x"></i>
               Data List Keranjang
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                     Beranda
                  </a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=keranjang" aria-current="page" class="text-decoration-none">
                     Data List Keranjang
                  </a>
               </li>
            </div>
         </div>
         <div class="panel-body">
            <section class="content">
               <div class="content-wrapper">
                  <div class="card shadow mb-3">
                     <div class="card-header py-3">
                        <h4 class="card-title display-4 fst-normal fw-normal fs-4">
                           <?php echo $_SESSION['nama_pelanggan'] . " - List Keranjang"; ?>
                        </h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools"></div>
                        <div class="card-footer my-1">
                           <div class="contaier-fluid">
                              <div class="table-responsive">
                                 <table class="table table-striped-columns">
                                    <thead>
                                       <tr>
                                          <th class="text-center fw-normal">No</th>
                                          <th class="text-center fw-normal">Produk</th>
                                          <th class="text-center fw-normal">Harga</th>
                                          <th class="text-center fw-normal">Jumlah</th>
                                          <th class="text-center fw-normal">Subharga</th>
                                          <th class="text-center fw-normal">Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $nomor = 1; ?>
                                       <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                       <?php
                                       $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                       $pecah = $ambil->fetch_array();
                                       $subharga = $pecah["harga_produk"] * (int)$jumlah;
                                       ?>
                                       <tr>
                                          <td class="text-center fw-normal fst-normal"><?php echo $nomor; ?></td>
                                          <td class="text-center fw-normal fst-normal">
                                             <?php echo $pecah["nama_produk"]; ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal">Rp.
                                             <?php echo number_format($pecah["harga_produk"]); ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal"><?php echo (int)$jumlah; ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal">Rp.
                                             <?php echo number_format($subharga); ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal">
                                             <a href="?aksi=hapus&id=<?= $id_produk ?>"
                                                class="btn btn-danger btn-xs">Hapus</a>
                                          </td>
                                       </tr>
                                       <?php $nomor++; ?>
                                       <?php endforeach; ?>
                                    </tbody>
                                 </table>
                                 <a href="?page=beranda" class="btn btn-default">Lanjutkan Belanja</a>
                                 <a href="?page=checkout" class="btn btn-primary">Checkout</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <?php require_once("../ui/footer.php"); ?>