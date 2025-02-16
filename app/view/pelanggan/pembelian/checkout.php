<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      if (!isset($_SESSION["id_pelanggan"])) {
         echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
         echo "<script>location='../../index.php'</script>";
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
               <i class="fas fa-check fa-fw fa-1x"></i>
               Data List Checkout
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                     Beranda
                  </a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=checkout" aria-current="page" class="text-decoration-none">
                     Data List Checkout
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
                           <?php echo $_SESSION['pelanggan_nama'] . " - List Checkout"; ?>
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
                                          <th class="text-center fw-normal fst-normal">No</th>
                                          <th class="text-center fw-normal fst-normal">Produk</th>
                                          <th class="text-center fw-normal fst-normal">Harga</th>
                                          <th class="text-center fw-normal fst-normal">Jumlah</th>
                                          <th class="text-center fw-normal fst-normal">Subharga</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                    if (!isset($_SESSION["keranjang"]) || !is_array($_SESSION["keranjang"])) {
                                       $_SESSION["keranjang"] = [];
                                    }
                                    ?>
                                       <?php
                                    $nomor = 1;
                                    $totalbelanja = 0;
                                    if (!empty($_SESSION["keranjang"])) {
                                       foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
                                          $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                          if ($ambil->num_rows > 0) {
                                             $pecah = $ambil->fetch_array();
                                             $subharga = $pecah["harga_produk"] * (int)$jumlah;
                                          } else {
                                             $pecah = ["nama_produk" => "Produk tidak ditemukan", "harga_produk" => 0];
                                             $subharga = 0;
                                          }
                                    ?>
                                       <tr>
                                          <td class="text-center fw-normal fst-normal"><?php echo $nomor; ?></td>
                                          <td class="text-center fw-normal fst-normal">
                                             <?php echo $pecah["nama_produk"]; ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal">Rp.
                                             <?php echo number_format($pecah["harga_produk"]); ?>
                                          </td>
                                          <td class="text-center fw-normal fst-normal">
                                             <?php echo (int)$jumlah; ?></td>
                                          <td class="text-center fw-normal fst-normal">Rp.
                                             <?php echo number_format($subharga); ?>
                                          </td>
                                       </tr>
                                       <?php $nomor++; ?>
                                       <?php $totalbelanja += $subharga; ?>
                                       <?php endforeach; ?>
                                       <?php } else { ?>
                                       <tr>
                                          <td colspan='5' style='text-align: center; font-weight: bold;'>Keranjang
                                             Kosong</td>
                                       </tr>
                                       <?php } ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th colspan="4">Total Belanja</th>
                                          <th class="text-center">Rp. <?php echo number_format($totalbelanja) ?></th>
                                    </tfoot>
                                 </table>
                              </div>
                              <form action="?aksi=checkout" class="form-group" method="post">
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-start align-items-start flex-wrap">
                                       <div class="col-sm col-sm-3">
                                          <label for="">Pelanggan</label>
                                       </div>
                                       <div class="col-sm col-sm-3">
                                          <input type="hidden" name="total_belanja" value="<?= $totalbelanja; ?>">
                                          <input type="text" name="id_pelanggan" class="form-control text-center"
                                             value="<?php echo $_SESSION["id_pelanggan"]; ?>" readonly id="">
                                       </div>
                                       <div class="col-sm col-sm-3">
                                          <input type="text" name="" class="form-control text-center"
                                             value="<?php echo $_SESSION["telepon"]; ?>" readonly id="">
                                       </div>
                                    </div>
                                    <div class="my-1"></div>
                                    <div class="row justify-content-start align-items-start flex-wrap">
                                       <div class="col-sm col-sm-3">
                                          <label for="">Ongkos Kirim</label>
                                       </div>
                                       <div class="col-sm col-sm-4">
                                          <select name="id_ongkir" class="form-select" id="">
                                             <option value="">Pilih Ongkos Kirim</option>
                                             <?php
                                          $ambil = $koneksi->query("SELECT * FROM ongkir");
                                          while ($perongkir = $ambil->fetch_assoc()) {
                                          ?>
                                             <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                                <?php echo $perongkir['nama_kota'] ?> -
                                                Rp. <?php echo number_format($perongkir['tarif']) ?>
                                             </option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="my-1"></div>
                                    <div class="row justify-content-start align-items-start flex-wrap">
                                       <div class="col-sm col-sm-3">
                                          <label for="">Alamat Lengkap Pengiriman</label>
                                       </div>
                                       <div class="col-sm col-sm-5">
                                          <textarea name="alamat_pengiriman" rows="5" class="form-control"
                                             placeholder="masukan alamat lengkap pengiriman (termasuk kode pos)"
                                             id=""></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm col-sm-8">
                                       <div class="my-2 text-end">
                                          <button type="submit" name="checkout" class="btn btn-primary">Checkout
                                             Belanja</button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <?php require_once("../ui/footer.php"); ?>