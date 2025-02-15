<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['akses'] == "admin"): ?>
        <?php require_once("../ui/header.php"); ?>
        <title><?php echo $judul; ?></title>
        <?php else: ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php endif; ?>
        <style type="text/css">
        .form-center {
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-start {
            justify-content: start;
            align-items: start;
            flex-wrap: wrap;
        }
        </style>
        <script lang="javascript">
        function rupiah() {
            var uang = document.getElementById('hrg').value;
            uang = Intl.NumberFormat('id-ID', {
                style: "currency",
                currency: "IDR"
            }).format(uang);
            document.getElementById("price").innerText = uang;
        }
        </script>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="fas fa-plus fa-1x text-danger"></i>
                    <i class="fas fa-gifts fa-1x text-dark shadow"></i>
                    Tambah List Product
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=produk" aria-current="page" class="text-decoration-none">
                            Data List Product
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambahproduk" aria-current="page" class="text-decoration-none">
                            Tambah List Product
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body my-2">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="col-sm col-sm-6 col-md col-md-6">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h4 class="card-title text-center fs-4 display-4 fw-normal"><?php echo $judul; ?></h4>
                            </div>
                            <div class="card-body my-2">
                                <form action="?aksi=tambah-produk" enctype="multipart/form-data" class="form-group"
                                    method="post">
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Nama Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="masukkan nama produk ..." autofocus id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Nama Kategori</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <select name="id_kategori" class="form-select" id="">
                                                    <option value="">Pilih Kategori Produk</option>
                                                    <?php $result = $category->ListKategori(); ?>
                                                    <?php foreach ($result as $data): ?>
                                                    <option value="<?= $data['id_kategori'] ?>">
                                                        <?php echo $data['id_kategori'] . " - " . $data['nama_kategori']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Harga Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <input type="text" name="harga" maxlength="11" inputmode="numeric"
                                                    class="form-control" placeholder="masukkan Harga Produk ..."
                                                    onkeyup="rupiah()" autofocus id="hrg">
                                                <small id="price"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Berat Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <input type="text" name="berat" maxlength="11" inputmode="numeric"
                                                    class="form-control" placeholder="masukkan Berat Produk ..."
                                                    autofocus id="">
                                            </div>
                                            <div class="my-1"></div>
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Jenis Berat</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <select name="jenis" class="form-select" id="">
                                                    <option value="">Pilih Jenis Berat Produk</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="g">Gram</option>
                                                    <option value="ton">Ton</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Deskripsi Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <textarea name="deskripsi" id="" class="form-control" rows="6"
                                                    maxlength="1000"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-start">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="nama">Stok Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-6">
                                                <input type="text" name="stok" maxlength="11" inputmode="numeric"
                                                    class="form-control" placeholder="masukkan stok Produk ..."
                                                    autofocus id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-start flex-wrap">
                                            <div class="form-label col-sm col-sm-4">
                                                <label for="">Foto Produk</label>
                                            </div>
                                            <div class="col-sm col-sm-8">
                                                <div class="form-icon img-thumbnail w-25">
                                                    <img id="preview" src="<?= BASE_URL ?>assets/default/user_logo.png"
                                                        alt="" width="80" height="80" class="img-rounded img-fluid">
                                                </div>
                                                <div class="form-control my-3">
                                                    <input type="file" name="foto" accept="image/*"
                                                        class="form-control-file" onchange="previewImage(this)"
                                                        aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="simpan">Simpan
                                                Produk</button>
                                            <button type="reset" class="btn btn-danger">Hapus Semua</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>