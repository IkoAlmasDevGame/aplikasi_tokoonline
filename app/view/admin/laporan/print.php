<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['akses'] == "admin"): ?>
        <?php require_once("../ui/header.php"); ?>
        <title><?php echo $judul; ?></title>
        <?php
        $semuadata = array();
        $tgl_mulai = "-";
        $tgl_selesai = "-";
        $tgl_mulai = $_GET["tglm"];
        $tgl_selesai = $_GET['tgls'];
        $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
		    pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
        while ($pecah = $ambil->fetch_assoc()):
            $semuadata[] = $pecah;
        endwhile;
        ?>
        <?php else: ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php endif; ?>
    </head>

    <body onload="window.print();">
        <div class="content">
            <div class="content-wrapper">
                <h2 class="text-center display-4 fs-3 fw-normal fst-normal">
                    Laporan <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?>
                </h2>
                <div style="min-width: 595px; min-height: 842px;">
                    <div class="table-responsive w-100">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center fw-normal fst-normal">Nomor</th>
                                <th class="text-center fw-normal fst-normal">Pelanggan</th>
                                <th class="text-center fw-normal fst-normal">Tanggal</th>
                                <th class="text-center fw-normal fst-normal">Jumlah</th>
                                <th class="text-center fw-normal fst-normal">Status</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php $total = 0; ?>
                            <?php foreach ($semuadata as $data): ?>
                            <?php $total += $data['total_pembelian'] ?>
                            <tr>
                                <td class="text-center fw-normal"><?php echo $no; ?></td>
                                <td class="text-center fw-normal">
                                    <?php echo $data['nama_pelanggan'] ?>
                                </td>
                                <td class="text-center fw-normal">
                                    <?php echo $data["tanggal_pembelian"] ?>
                                </td>
                                <td class="text-center fw-normal">
                                    <?php echo number_format($data["total_pembelian"]) ?>
                                </td>
                                <td class="text-center fw-normal">
                                    <?php echo $data["status_pembelian"] ?>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach; ?>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th colspan="2">Rp. <?php echo number_format($total) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>