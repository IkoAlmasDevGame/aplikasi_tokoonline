<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['akses'] == "admin"): ?>
        <?php require_once("../ui/header.php"); ?>
        <title><?php echo $judul; ?></title>
        <?php
        if (!isset($_GET['id'])):
            die("ID pembelian tidak ditemukan.");
        endif;

        $id_pembelian = $_GET['id'];
        // Mengambil data pembayaran berdasarkan ID pembelian
        $stmt = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
        $detail = $stmt->fetch_assoc();

        if (!$detail) {
            echo "<script>alert('Data pembayaran tidak ditemukan untuk ID pembelian ini.')</script>";
            $halaman = URL_BASE2 . "ui/header.php?page=pembelian";
            echo "<script>document.location.href = '$halaman';</script>";
            die;
        }

        // Validasi file bukti pembayaran
        $file_path = BASE_URL . "bukti_pembayaran/" . $detail['bukti'];
        if (!file_exists($file_path)) {
            echo "<script>alert('File bukti pembayaran tidak ditemukan.')</script>";
            $halaman = URL_BASE2 . "ui/header.php?page=pembelian";
            echo "<script>document.location.href = '$halaman';</script>";
            die;
        }

        ?>
        <?php else: ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php endif; ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="content">
            <div class="content-wrapper">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td><?php echo $detail['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <td><?php echo $detail['bank'] ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?php echo $detail['tanggal'] ?></td>
                                </tr>
                            </table>
                            <div class="col-md-6">
                                <img src="<?php echo $file_path ?>" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="my-1"></div>
                        <form action="?aksi=pembayaran-pelanggan" class="form-group" method="post">
                            <input type="hidden" name="id_pembelian" value="<?= $id_pembelian ?>">
                            <div class="form-inline my-2">
                                <div class="row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-6">Nomer Resi Pengiriman</div>
                                    <div class="col-sm-6">
                                        <input type="text" name="resi" class="form-control"
                                            placeholder="masukkan nomer resi pengiriman ..." id="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline my-2">
                                <div class="row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-6">Status</div>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="status">
                                            <option value="">Pilih Status</option>
                                            <option value="lunas">Lunas</option>
                                            <option value="barang dikirim">Barang Dikirim</option>
                                            <option value="batal">Batal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 my-2">
                                <button type="submit" class="btn btn-primary" name="proses">Proses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>