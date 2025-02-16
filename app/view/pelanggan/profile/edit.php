<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php $pagedesc = "Data Profile Pribadi"; ?>
      <?php if ($_SESSION['akses'] == 'pelanggan') { ?>
      <?php require_once("../ui/header.php"); ?>
      <title><?php echo $judul ?></title>
      <?php } else { ?>
      <?php header("location:../ui/header.php?page=beranda"); ?>
      <?php exit(0); ?>
      <?php } ?>
      <style type="text/css">
      .fst-times {
         font-family: 'Times New Roman';
         font-weight: 500;
         font-style: normal;
      }
      </style>
   </head>

   <body>
      <?php require_once("../ui/sidebar.php"); ?>
      <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
         <div class="panel-heading py-4 container-fluid">
            <h4 class="panel-title display-4 fs-3 fst-times">
               <?php echo $judul ?></h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary">Beranda</a>
               </li>
               <li class="breadcrumb breadcrumb-item">
                  <a href="?page=profile&id_pelanggan=<?= $_GET['id_pelanggan'] ?>" aria-current="page"
                     class="text-decoration-none active"><?php echo $judul; ?></a>
               </li>
            </div>
         </div>
         <div class="panel-body">
            <section class="content">
               <div class="content-wrapper">
                  <div class="p-1 p-lg-1 m-1 m-lg-1">
                     <div class="mb-3"></div>
                     <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <?php if (isset($_GET['id_pelanggan'])) : ?>
                        <?php $dataUser = $users->edit($_GET['id_pelanggan']); ?>
                        <?php foreach ($dataUser as $row) { ?>
                        <div class="card col-sm-7 col-md-7 mb-3">
                           <div class="card-header py-2">
                              <h4 class="card-title fs-4 display-4 fst-times">
                                 <?php echo "<div class='display-4 fs-4 text-center fst-times text-dark my-2'>Data Profile : $row[nama_pelanggan]</div><br"; ?>
                              </h4>
                           </div>
                           <div class="card-body my-2">
                              <?php if (isset($_GET['data'])) { ?>
                              <?php foreach ($dataUser as $data) { ?>
                              <form action="?aksi=perbarui-profile" enctype="multipart/form-data" class="form-group"
                                 method="post">
                                 <input type="hidden" name="id_pelanggan" value="<?= $data['id_pelanggan'] ?>">
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="" class="label label-default">Nama Lengkap</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="text" class="form-control" name="nama_pelanggan"
                                             value="<?= $data['nama_pelanggan'] ?>" id="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="" class="label label-default">Email</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="text" class="form-control" name="email_pelanggan"
                                             value="<?= $data['email_pelanggan'] ?>" id="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="" class="label label-default">Telepon</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="text" class="form-control" name="telepon"
                                             value="<?= $data['telepon'] ?>" id="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="" class="label label-default">Alamat</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <textarea name="alamat_pelanggan" class="form-control" readonly
                                             id=""><?php echo $row['alamat_pelanggan'] ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-start flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 display-4 fs-5 fst-times">
                                          <label for="" class="label label-default">Foto</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <div class="form-icon img-thumbnail w-25">
                                             <?php $file = __FILE__ . "user_logo.png"; ?>
                                             <?php $dir = __DIR__ . "../../../../assets/default/" . $file; ?>
                                             <?php if ($data['gambar'] != $dir) { ?>
                                             <img id="preview" src="../../../../assets/foto/<?= $data['gambar'] ?>"
                                                alt="" width="64" class="img-rounded img-fluid">
                                             <?php } else { ?>
                                             <img src="<?php echo $dir ?>" alt="" width="64"
                                                class="img-rounded img-fluid">
                                             <?php } ?>
                                          </div>
                                          <div class="form-control my-3">
                                             <input type="file" name="gambar" accept="image/*" class="form-control-file"
                                                onchange="previewImage(this)" aria-required="true">
                                             <div class="my-1"></div>
                                             <input type="checkbox" name="ganti" id=""> Klik jika
                                             ingin ubah foto
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php if (isset($_GET['data'])) { ?>
                                 <div class="card-footer">
                                    <div class="text-start">
                                       <button type="submit" name="submitEdit" class="btn btn-primary">
                                          <i class="fas fa-fw fa-save"></i>
                                          Update Data
                                       </button>
                                       <a href="?page=profile&id_pelanggan=<?= $data['id_pelanggan'] ?>"
                                          aria-current="page" class="btn btn-danger">
                                          <i class="fas fa-fw fa-close"></i>
                                          Cancel
                                       </a>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </form>
                              <?php } ?>
                              <?php } elseif (isset($_GET['change'])) { ?>
                              <?php foreach ($dataUser as $isi): ?>
                              <form action="?aksi=perbarui-password" class="form-group" method="post">
                                 <input type="hidden" name="id_pelanggan" value="<?= $isi['id_pelanggan'] ?>">
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="old_password" class="label label-default">Old
                                             Password</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="password" placeholder="masukkan password lama ..."
                                             class="form-control" name="old_password" value="" required
                                             id="old_password" aria-required="TRUE">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="new_password" class="label label-default">Password</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="password" placeholder="masukkan password baru ..."
                                             class="form-control" name="new_password" value="" required
                                             id="new_password" aria-required="TRUE">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                          <label for="new_password_verify" class="label label-default">Password
                                             Verify</label>
                                       </div>
                                       <div class="col-sm-1 col-md-1">:</div>
                                       <div class="col-sm-6 col-md-6">
                                          <input type="password" placeholder="ulangi password baru anda ..."
                                             class="form-control" name="new_password_verify" value="" required
                                             id="new_password_verify" aria-required="TRUE">
                                       </div>
                                    </div>
                                 </div>
                                 <?php if (isset($_GET['change'])): ?>
                                 <div class="card-footer">
                                    <div class="text-start">
                                       <button type="submit" name="submitPassword" class="btn btn-primary">
                                          <i class="fas fa-fw fa-save"></i>
                                          Update Password
                                       </button>
                                       <a href="?page=profile&id_pelanggan=<?= $isi['id_pelanggan'] ?>"
                                          aria-current="page" class="btn btn-danger">
                                          <i class="fas fa-fw fa-close"></i>
                                          Cancel
                                       </a>
                                    </div>
                                 </div>
                                 <?php endif; ?>
                              </form>
                              <?php endforeach; ?>
                           </div>
                           <?php } else { ?>
                           <div class="form-inline my-2">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                    <label for="" class="label label-default">Nama Lengkap</label>
                                 </div>
                                 <div class="col-sm-1 col-md-1">:</div>
                                 <div class="col-sm-6 col-md-6">
                                    <input type="text" class="form-control" name="username"
                                       value="<?= $row['nama_pelanggan'] ?>" id="" readonly>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-2">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                    <label for="" class="label label-default">Nama Lengkap</label>
                                 </div>
                                 <div class="col-sm-1 col-md-1">:</div>
                                 <div class="col-sm-6 col-md-6">
                                    <input type="text" class="form-control" name="email"
                                       value="<?= $row['email_pelanggan'] ?>" id="" readonly>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-2">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                    <label for="" class="label label-default">Nomor Telepon</label>
                                 </div>
                                 <div class="col-sm-1 col-md-1">:</div>
                                 <div class="col-sm-6 col-md-6">
                                    <input type="text" class="form-control" name="email" value="<?= $row['telepon'] ?>"
                                       id="" readonly>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-2">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                    <label for="" class="label label-default">Alamat</label>
                                 </div>
                                 <div class="col-sm-1 col-md-1">:</div>
                                 <div class="col-sm-6 col-md-6">
                                    <textarea name="alamat" class="form-control" readonly
                                       id=""><?php echo $row['alamat_pelanggan'] ?></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="card-footer my-2">
                              <div class="text-start">
                                 <a href="?page=profile&id_pelanggan=<?= $row['id_pelanggan'] ?>&data=<?= $row['id_pelanggan'] ?>"
                                    aria-current="page" class="btn btn-success">
                                    <i class="fas fa-fw fa-edit"></i>
                                    Edit
                                 </a>
                                 <a href="?page=profile&id_pelanggan=<?= $row['id_pelanggan'] ?>&change=<?= $row['id_pelanggan'] ?>"
                                    aria-current="page" class="btn btn-danger">
                                    <i class="fas fa-fw fa-lock"></i>
                                    Change Password
                                 </a>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <?php require_once("../ui/footer.php"); ?>