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
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="fas fa-user-friends fa-1x"></i>
                    Data List Pelanggan
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=pelanggan" aria-current="page" class="text-decoration-none">
                            Data List Pelanggan
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body my-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-3">
                            <div class="card-header py-2">
                                <h4 class="card-title display-4 fw-normal fst-normal">
                                    Data List Pelanggan
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <div class="text-start">
                                        <a href="?page=pelanggan" aria-current="page"
                                            class="btn btn-info btn-outline-dark">
                                            <i class="fa fa-refresh fa-1x fa-fw"></i>
                                            Refresh Halaman
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
                                        <div class="d-table w-100">
                                            <table class="table table-striped-columns table-bordered" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fw-normal fst-normal">Opsional</th>
                                                        <th class="text-center fw-normal fst-normal">Nomor</th>
                                                        <th class="text-center fw-normal fst-normal">
                                                            Email Pelanggan
                                                        </th>
                                                        <th class="text-center fw-normal fst-normal">Nama Pelanggan</th>
                                                        <th class="text-center fw-normal fst-normal">
                                                            Telepon Pelanggan
                                                        </th>
                                                        <th class="text-center fw-normal fst-normal">
                                                            Alamat Pelanggan
                                                        </th>
                                                        <th class="text-center fw-normal fst-normal">
                                                            Gambar Pelanggan
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $result = $pelanggan->ListPelanggan(); ?>
                                                    <?php foreach ($result as $data): ?>
                                                    <?php extract($data); ?>
                                                    <tr>
                                                        <td class="text-center fw-normal">
                                                            <a href="?aksi=hapus-pelanggan&id_pelanggan=<?= $id_pelanggan ?>"
                                                                aria-current="page"
                                                                onclick="return confirm('Apakah anda ingin menghapus data pelanggan ini ?')"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash-alt fa-1x"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center fw-normal"><?php echo $no; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $email_pelanggan; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $nama_pelanggan; ?>
                                                        </td>
                                                        <td class="text-center fw-normal"><?php echo $telepon; ?></td>
                                                        <td class="text-wrap fw-normal">
                                                            <?php
                                                            $a = $data['alamat_pelanggan'];
                                                            if (strlen($a) > 25) {
                                                                echo substr($a, 0, 25), "<a href='' class='text-decoration-none' role='button' data-bs-toggle='modal' 
                                                                    data-bs-target='#alamat$data[id_pelanggan]' aria-controls='deskripsi_produk' aria-expanded='false' aria-label='deskripsi alamat'> ...</a>";
                                                            } else {
                                                                echo $a;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <img src="<?= BASE_URL ?>assets/foto/<?= $data['gambar'] ?>"
                                                                alt="" class="img-responsive"
                                                                style="width: 50px; max-width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="alamat<?= $data['id_pelanggan'] ?>"
                                                        tabindex="-1" aria-hidden="true"
                                                        aria-labelledby="deskripsi produk">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="alamat<?= $data['id_pelanggan'] ?>">
                                                                        <?php echo $data['nama_pelanggan'] ?></h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body my-1">
                                                                    <div class="text-end">
                                                                        <img src="<?= BASE_URL ?>assets/foto/<?= $data['gambar'] ?>"
                                                                            alt="" class="img-responsive"
                                                                            style="width: 50px; max-width: 100%;">
                                                                        <br>
                                                                        <small><?php echo $data['nama_pelanggan'] ?></small>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row justify-content-start align-items-start
                                                                             flex-wrap">
                                                                            <div
                                                                                class="col-sm-6 fst-normal fw-normal fs-5">
                                                                                <label for="">Nama Pelanggan :</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <p class="text-dark text-wrap fw-normal
                                                                                 fst-normal">
                                                                                <?php echo $data['nama_pelanggan'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row justify-content-start align-items-start
                                                                             flex-wrap">
                                                                            <div
                                                                                class="col-sm-6 fst-normal fw-normal fs-5">
                                                                                <label for="">Alamat Pelanggan :</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <p class="text-dark text-wrap fw-normal
                                                                                 fst-normal">
                                                                                <?php echo $data['alamat_pelanggan'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-start align-items-start
                                                                             flex-wrap">
                                                                        <div class="col-sm-7 fst-normal fw-normal fs-5">
                                                                            <label for="">Nomor Telepon :</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <a href="https://wa.me/<?= $data['telepon'] ?>"
                                                                            class="text-decoration-none text-primary">
                                                                            <?php echo $telepon; ?>
                                                                        </a>
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
        <?php require_once("../ui/footer.php"); ?>