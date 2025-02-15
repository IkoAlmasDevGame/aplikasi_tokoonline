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
                    <i class="fas fa-book fa-1x"></i>
                    Data List Kategori
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=kategori" aria-current="page" class="text-decoration-none">
                            Data List Kategori
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body my-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="card-title display-4 fw-normal fst-normal">
                                    <?php echo "Data List Kategori"; ?></h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <?php if (isset($_GET['id'])): ?>
                                    <?php $results = $koneksi->query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'"); ?>
                                    <?php $d = mysqli_fetch_array($results); ?>
                                    <form action="?aksi=edit-kategori" class="form-group" method="post">
                                        <input type="hidden" name="id_kategori" value="<?= $d['id_kategori'] ?>">
                                        <div class="col-sm col-sm-5">
                                            <div class="form-inline my-1">
                                                <div class="row justify-content-start align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4">
                                                        <label for="">Nama Kategori</label>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="nama_kategori"
                                                            value="<?= $d['nama_kategori'] ?>" id="">
                                                        <div class="text-end my-1">
                                                            <button type="submit" name="ubahSimpan"
                                                                class="btn btn-primary">
                                                                Ubah Simpan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                    <form action="?aksi=tambah-kategori" class="form-group" method="post">
                                        <div class="col-sm col-sm-5">
                                            <div class="form-inline my-1">
                                                <div class="row justify-content-start align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4">
                                                        <label for="">Nama Kategori</label>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="nama_kategori"
                                                            value="" placeholder="masukkan kategori ..." id="">
                                                        <div class="text-end my-1">
                                                            <button type="submit" name="simpan" class="btn btn-primary">
                                                                Simpan Kategori
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                    <div class="border border-top my-2"></div>
                                    <a href="?page=kategori" aria-current="page" class="btn btn-info btn-outline-dark">
                                        <i class="fa fa-refresh fa-1x fa-fw"></i>
                                        Refresh Halaman
                                    </a>
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
                                    <div class="container">
                                        <div class="table-responsive">
                                            <table class="table table-striped-columns table-bordered" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fw-normal fst-normal">Optional</th>
                                                        <th class="text-center fw-normal fst-normal">Nomor</th>
                                                        <th class="text-center fw-normal fst-normal">Nama Kategori</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $result = $category->ListKategori(); ?>
                                                    <?php foreach ($result as $data): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal fst-normal">
                                                            <a href="?aksi=hapus-kategori&id_kategori=<?= $data['id_kategori'] ?>"
                                                                aria-current="page" onclick="return confirm('')"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash-alt fa-fw fa-1x"></i>
                                                            </a>
                                                            <a href="?page=kategori&id=<?= $data['id_kategori'] ?>"
                                                                aria-current="page" class="btn btn-warning">
                                                                <i class="fa fa-edit fa-fw fa-1x"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center fw-normal fst-normal">
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td class="text-center fw-normal fst-normal">
                                                            <?php echo $data['nama_kategori'] ?>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>