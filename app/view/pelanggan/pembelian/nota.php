<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['akses'] == "pelanggan"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php
      $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
       WHERE pembelian.id_pembelian='$_GET[id]'");
      $detail = $ambil->fetch_assoc();
      $idpelangganyangbeli = $detail["id_pelanggan"];

      //mendapatkan id_pelanggan yg login
      $idpelangganyanglogin = $_SESSION["id_pelanggan"];

      if ($idpelangganyangbeli !== $idpelangganyanglogin) {
         echo "<script>alert('data bersifat privasi!');</script>";
         echo "<script>location='?page=riwayat';</script>";
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
               <i class="fas fa-book fa-fw fa-1x"></i>
               Data List Nota
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                     Beranda
                  </a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=nota&id=<?= $_GET['id'] ?>" aria-current="page" class="text-decoration-none">
                     Data List Nota
                  </a>
               </li>
            </div>
         </div>
         <div class="panel-body">
            <section class="content">
               <div class="content-wrapper">
                  <div class="row">
                     <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
                        Tanggal: <?php echo $detail['tanggal_pembelian'] ?><br>
                        Total: Rp. <?php echo number_format($detail['total_pembelian']) ?>
                     </div>
                     <div class="col-md-4">
                        <h3>Data Pelanggan</h3>
                        <strong><?php echo $detail['nama_pelanggan'] ?></strong> <br>
                        <p>
                           Email: <?php echo $detail['email_pelanggan']; ?> <br>
                           No Telepon: <?php echo $detail['telepon']; ?>
                        </p>
                     </div>
                     <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <strong><?php echo $detail['nama_kota'] ?></strong><br>
                        Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
                        Alamat: <?php echo $detail['alamat_pengiriman'] ?>
                     </div>
                  </div>
                  <div class="card shadow mb-3">
                     <div class="card-header py-2">
                        <h4 class="card-title display-4 fst-normal fw-normal">Nota Pembelian</h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools"></div>
                        <div class="card-footer my-2">
                           <div class="table-responsive">
                              <div class="container-fluid">
                                 <table class="table table-striped-columns">
                                    <thead>
                                       <tr>
                                          <th class="text-center fw-normal">No</th>
                                          <th class="text-center fw-normal">Nama Produk</th>
                                          <th class="text-center fw-normal">Harga</th>
                                          <th class="text-center fw-normal">Berat</th>
                                          <th class="text-center fw-normal">Jumlah</th>
                                          <th class="text-center fw-normal">Subberat</th>
                                          <th class="text-center fw-normal">Subtotal</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $nomor = 1; ?>
                                       <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                                       <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                       <tr>
                                          <td class="text-center fw-normal"><?php echo $nomor; ?></td>
                                          <td class="text-center fw-normal"><?php echo $pecah['nama']; ?></td>
                                          <td class="text-center fw-normal">Rp.
                                             <?php echo number_format($pecah['harga']); ?></td>
                                          <td class="text-center fw-normal"><?php echo $pecah['berat']; ?> Gr</td>
                                          <td class="text-center fw-normal"><?php echo $pecah['jumlah']; ?></td>
                                          <td class="text-center fw-normal"><?php echo $pecah['subberat']; ?> Gr</td>
                                          <td class="text-center fw-normal">Rp.
                                             <?php echo number_format($pecah['subharga']); ?></td>
                                       </tr>
                                       <?php $nomor++; ?>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                                 <div class="row">
                                    <div class="col-md-7">
                                       <div class="alert alert-info">
                                          <p>
                                             Silahkan Melakukan Pembayaran Sebesar Rp.
                                             <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                                             <strong>Rekening 000-0000-0000 (BANK SALAHIN) AN. CHACHA</strong>
                                          </p>
                                       </div>
                                    </div>
                                 </div>
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