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
        .table {
            width: 1100px;
        }

        @media screen and (min-width:1100px) {
            .table {
                min-width: 1100px;
            }
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="fas fa-gifts fa-1x"></i>
                    Data List Product
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
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-2 display-2 text-black fst-normal fw-normal">
                                    Data List Product
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <div class="text-start">
                                        <a href="?page=produk" aria-current="page"
                                            class="btn btn-info btn-outline-dark">
                                            <i class="fa fa-refresh fa-1x fa-fw"></i>
                                            Refresh Halaman
                                        </a>
                                        <a href="?page=produk&stok=yes" aria-current="page"
                                            class="btn btn-success btn-outline-dark">
                                            <i class="fa fa-gifts fa-1x fa-fw"></i>
                                            Stok Product
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-end flex-wrap">
                                        <div class="col-sm-2 col-md-2 text-center">
                                            <div class="rounded-2 bg-info py-2 text-light fs-5 fw-bold">
                                                <marquee behavior="scroll" scrollamount="15" direction="left">
                                                    <?php echo salam() . ", " . $_SESSION['name'] ?>
                                                </marquee>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer my-2">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-striped-columns table-bordered" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fs-6 fw-normal">Opsional</th>
                                                        <th class="text-center fs-6 fw-normal">Nomor</th>
                                                        <th class="text-center fs-6 fw-normal">Nama Produk</th>
                                                        <th class="text-center fs-6 fw-normal">Nama Kategori</th>
                                                        <th class="text-center fs-6 fw-normal">Harga Produk</th>
                                                        <th class="text-center fs-6 fw-normal">Berat Produk</th>
                                                        <th class="text-center fs-6 fw-normal">Deskripsi Produk</th>
                                                        <th class="text-center fs-6 fw-normal">Foto Produk</th>
                                                        <th class="text-center fs-6 fw-normal">Stok Produk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php if (isset($_POST['stok']) == "yes"): ?>
                                                    <?php $result = $product->ListProdukStok(); ?>
                                                    <?php else: ?>
                                                    <?php $result = $product->ListProduk(); ?>
                                                    <?php foreach ($result as $data): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal">
                                                            <a href="?aksi=hapus-produk&id_produk=<?= $data['id_produk'] ?>"
                                                                role="button" aria-current="page" class="btn btn-danger"
                                                                onclick="return confirm('Apakah anda ingin menghapus produk ini ? <?php echo $data['nama_produk'] ?>')">
                                                                <i class="fas fa-fw fa-trash-alt fa-1x"></i>
                                                            </a>
                                                            <a href="?aksi=editproduk&id=<?= $data['id_produk'] ?>"
                                                                role="button" aria-current="page"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-fw fa-1x fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $data['nama_produk']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $data['nama_kategori']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($data['harga_produk'], 2, ".", ","); ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $data['berat_produk'] . " " . $data['jenis_berat']; ?>
                                                        </td>
                                                        <td class="text-wrap text-start fw-normal">
                                                            <?php
                                                                $a = $data['deskripsi_produk'];
                                                                if (strlen($a) > 24) {
                                                                    echo substr($a, 0, 24), "<a href='' class='text-decoration-none' role='button' data-bs-toggle='modal' 
                                                                    data-bs-target='#deskripsi$data[id_produk]' aria-controls='deskripsi_produk' aria-expanded='false' aria-label='deskripsi produk'>...</a>";
                                                                } else {
                                                                    echo $a;
                                                                }
                                                                ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <img src="<?= BASE_URL ?>assets/foto_produk/<?= $data['foto_produk'] ?>"
                                                                alt="" class="img-responsive"
                                                                style="width: 50px; max-width: 100%;">
                                                        </td>
                                                        <?php if ($data['stok_produk'] == '3'): ?>
                                                        <td class="text-center fw-normal">
                                                            <form action="?aksi=update-stok"
                                                                enctype="multipart/form-data" method="post">
                                                                <input type="hidden" name="id_produk"
                                                                    value="<?= $data['id_produk'] ?>">
                                                                <div class="row justify-content-center align-items-center
                                                                            flex-wrap">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" name="stokbaru"
                                                                            inputmode="numeric" id=""
                                                                            class="form-control"
                                                                            placeholder="Sisa Stok Produk <?= $data['stok_produk'] ?>">
                                                                        <br>
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-primary"
                                                                            name="ubahStock">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <?php else: ?>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $data['stok_produk'] ?>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <div class="modal fade" id="deskripsi<?= $data['id_produk'] ?>"
                                                        tabindex="-1" aria-hidden="true"
                                                        aria-labelledby="deskripsi produk">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="deskripsi<?= $data['id_produk'] ?>">
                                                                        <?php echo $data['nama_produk'] ?></h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body my-1">
                                                                    <div class="text-end">
                                                                        <img src="<?= BASE_URL ?>assets/foto_produk/<?= $data['foto_produk'] ?>"
                                                                            alt="" class="img-responsive"
                                                                            style="width: 50px; max-width: 100%;">
                                                                        <br>
                                                                        <small><?php echo $data['nama_produk'] ?></small>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row justify-content-start align-items-start
                                                                             flex-wrap">
                                                                            <div
                                                                                class="col-sm-4 fst-normal fw-normal fs-5">
                                                                                <label for="">Deskripsi Produk :</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <p
                                                                                class="text-dark text-wrap fw-normal fst-normal">
                                                                                <?php echo $data['deskripsi_produk'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $no++; ?>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <div class="text-end my-1">
                                                <a href="?aksi=tambahproduk" aria-current="page"
                                                    class="btn btn-primary btn-outline-dark">
                                                    <i class="fas fa-fw fa-plus-circle fa-1x"></i>
                                                    Tambah List Product
                                                </a>
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