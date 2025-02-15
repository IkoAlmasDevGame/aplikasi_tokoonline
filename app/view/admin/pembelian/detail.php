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
    <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'"); ?>
    <?php $detail = $ambil->fetch_assoc(); ?>
    <strong><?php echo $detail['nama_pelanggan'] ?></strong>
    <div class="my-2"></div>
    <p>
        Email: <?php echo $detail['email_pelanggan']; ?> <br>
        No Telepon: <?php echo $detail['telepon']; ?>
    </p>
    <p>
        Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
        Total: <?php echo $detail['total_pembelian']; ?>
    </p>
    <div class="my-2"></div>
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th class="text-center fw-normal">No</th>
                <th class="text-center fw-normal">Nama Produk</th>
                <th class="text-center fw-normal">Harga Produk</th>
                <th class="text-center fw-normal">Jumlah Produk</th>
                <th class="text-center fw-normal">Total Produk</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
            <?php foreach ($ambil as $pecah): ?>
                <tr>
                    <td class="text-center fw-normal"><?php echo $nomor; ?></td>
                    <td class="text-center fw-normal"><?php echo $pecah['nama_produk']; ?></td>
                    <td class="text-center fw-normal"><?php echo $pecah['harga_produk']; ?></td>
                    <td class="text-center fw-normal"><?php echo $pecah['jumlah']; ?></td>
                    <td class="text-center fw-normal">
                        <?php echo $pecah['harga_produk'] * $pecah['jumlah']; ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php require_once("../ui/footer.php"); ?>