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
                    <i class="fas fa-shopping-cart fa-fw fa-1x"></i>
                    Data List Pembelian
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=pembelian" aria-current="page" class="text-decoration-none">
                            Data List Pembelian
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body my-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-3">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-3 display-4 fst-normal fw-normal">
                                    Data List Pembelian
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools"></div>
                                <div class="card-footer my-2">
                                    <div class="container-fluid">
                                        <div class="d-table w-100">
                                            <div class="table-responsive">
                                                <table class="table table-striped-columns" id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal">Optional</th>
                                                            <th class="text-center fw-normal">Nomor</th>
                                                            <th class="text-center fw-normal">Nama Pelanggan</th>
                                                            <th class="text-center fw-normal">Tanggal</th>
                                                            <th class="text-center fw-normal">Status Pembelian</th>
                                                            <th class="text-center fw-normal">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1; ?>
                                                        <?php $result = $pembelian->ListPembelian(); ?>
                                                        <?php foreach ($result as $pecah): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="?page=detail&id=<?php echo $pecah['id_pembelian']; ?>"
                                                                    class="btn btn-info" aria-current="page">detail</a>
                                                                <?php if ($pecah['status_pembelian'] !== "pending"): ?>
                                                                <a href="?page=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>"
                                                                    class="btn btn-success"
                                                                    aria-current="page">Pembayaran</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $pecah['nama_pelanggan']; ?></td>
                                                            <td><?php echo $pecah['tanggal_pembelian']; ?></td>
                                                            <td><?php echo $pecah['status_pembelian']; ?></td>
                                                            <td><?php echo $pecah['total_pembelian']; ?></td>
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
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>