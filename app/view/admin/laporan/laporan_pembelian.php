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
        if (isset($_POST['kirim'])):
            $tgl_mulai = $_POST["tglm"];
            $tgl_selesai = $_POST['tgls'];
            $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
		    pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
            while ($pecah = $ambil->fetch_assoc()) {
                $semuadata[] = $pecah;
            }
        endif;
        ?>
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
                <i class="fas fa-file fa-1x"></i>
                Data List Laporan
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                        Beranda
                    </a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=laporan" aria-current="page" class="text-decoration-none">
                        Data List Laporan
                    </a>
                </li>
            </div>
        </div>
        <div class="panel-body my-2">
            <section class="content">
                <div class="content-wrapper">
                    <div class="card shadow mb-3">
                        <div class="card-header py-2">
                            <h4 class="card-title display-4 fst-normal fw-normal">
                                Data List Laporan <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?>
                            </h4>
                        </div>
                        <div class="card-body my-2">
                            <div class="card-tools">
                                <form action="?page=laporan" class="form-group" method="post">
                                    <div class="form-inline my-1">
                                        <div class="row justify-content-start align-items-start flex-wrap">
                                            <div class="col-sm-4 col-md-4">
                                                <label for="">Tanggal Mulai</label>
                                                <input type="date" name="tglm" class="form-control"
                                                    value="<?= $tgl_mulai ?>" id="">
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <label for="">Tanggal Selesai</label>
                                                <input type="date" name="tgls" class="form-control"
                                                    value="<?= $tgl_selesai ?>" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 my-1">
                                            <button type="submit" class="btn btn-primary" name="kirim">
                                                Lihat Tanggal
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="my-2 border border-top"></div>
                                <div class="text-start">
                                    <a href="?page=laporan" aria-current="page"
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
                                        <div class="table-responsive">
                                            <table class="table table-striped-columns" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fw-normal fst-normal">Nomor</th>
                                                        <th class="text-center fw-normal fst-normal">Pelanggan</th>
                                                        <th class="text-center fw-normal fst-normal">Tanggal</th>
                                                        <th class="text-center fw-normal fst-normal">Jumlah</th>
                                                        <th class="text-center fw-normal fst-normal">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
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
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3">Total</th>
                                                        <th>Rp. <?php echo number_format($total) ?></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <?php if (isset($_POST['tglm']) && isset($_POST['tgls'])): ?>
                                                <a href="?page=print-laporan&tglm=<?= $tgl_mulai ?>&tgls=<?= $tgl_selesai ?>"
                                                    aria-current="page" class="btn btn-primary">
                                                    <i class="fa fa-file-excel fa-1x"></i>
                                                    Download File excel
                                                </a>
                                            <?php else: ?>
                                                <span class="fst-fst-normal">Tidak ada file untuk di download.</span>
                                            <?php endif; ?>
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