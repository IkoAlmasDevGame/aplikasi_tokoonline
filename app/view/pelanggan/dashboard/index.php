<?php require_once("../ui/header.php") ?>
<?php require_once("../ui/sidebar.php") ?>

<!-- Layout Pada Dashboard -->
<section class="content">
   <div class="container">
      <h1 class="display-4 fs-3 fst-normal fw-normal">
         Produk Terbaru
         <div class="col-sm col-sm-1 border-warning border border-top"></div>
      </h1>
      <div class="row justify-content-start align-items-start flex-wrap">
         <?php $ambil = $koneksi->query("SELECT * FROM produk") ?>
         <?php foreach ($ambil as $pecah): ?>
            <div class="col-sm col-sm-3">
               <div class="img-thumbnail">
                  <div class="card">
                     <div class="card-header border-0 text-center">
                        <img src="<?= BASE_URL ?>assets/foto_produk/<?= $pecah['foto_produk'] ?>" class="img-responsive"
                           alt="" width="100" height="100">
                     </div>
                     <div class="card-body">
                        <div class="form-inline my-2">
                           <div class="row justify-content-center align-items-center flex-wrap">
                              <div class="col-sm-9 fs-6 fw-normal fst-normal">
                                 <div class="my-1">
                                    <?php echo $pecah['nama_produk'] ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-inline my-2">
                           <div class="row justify-content-center align-items-center flex-wrap">
                              <div class="col-sm-9 fs-6 fw-normal fst-normal">
                                 <div class="my-1">
                                    Rp. <?php echo number_format($pecah['harga_produk']) ?> ,-
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer my-2">
                           <a href="?page=beli&id=<?= $pecah['id_produk'] ?>" aria-current="page"
                              class="btn btn-primary">Beli</a>
                           <a href="?page=detail&id=<?= $pecah['id_produk'] ?>" aria-current="page"
                              class="btn btn-info">Detail</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</section>
<!-- Layout Pada Dashboard -->
<?php require_once("../ui/footer.php") ?>