<?php
# pengambilan database di config
require_once("../../../init.php");
$SQL = "SELECT * FROM setting"; # bisa di isi untuk pengambilan nama website atau settingan webiste
$setting = $koneksi->query($SQL);
$row = mysqli_fetch_array($setting);
# session
if (isset($_SESSION['status'])) {
    if (isset($_SESSION['id_pelanggan'])) {
        if (isset($_SESSION['pelanggan_email'])) {
            if (isset($_SESSION['nama_pelanggan'])) {
                if (isset($_SESSION['telepon'])) {
                    if (isset($_SESSION['akses'])) {
                        if (isset($_COOKIE['cookies'])) {
                            if (isset($_SERVER['HTTP_ACCEPT'])) {
                                if (isset($_SERVER['REDIRECT_STATUS'])) {
                                    if (isset($_SESSION['alamat'])) {
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../../index.php'
    }, 3000);
    </script>";
    die;
    exit(0);
}


# Files model dan Files controller
# Folder Files
require_once("../../../models/Authentication_model.php");
require_once("../../../models/Pengguna_model.php");
# require_once("../../../models/Setting_model.php");
require_once("../../../models/Produk_model.php");
require_once("../../../models/Kategori_model.php");
require_once("../../../models/Pembelian_model.php");
require_once("../../../models/Pembayaran_model.php");
# require_once("../../../models/Admin_model.php");
$product = new model\Produk_model($koneksi);
$category = new model\Kategori_model($koneksi);
$pelanggan = new model\Pengguna_model($koneksi);
$pembelian = new model\Pembelian_model($koneksi);
$pembayaran = new model\Pembayaran_model($koneksi);
# $adm = new model\Admin_model($koneksi);
# Folder Controller
require_once("../../../controllers/Authentication.php");
require_once("../../../controllers/Pengguna.php");
require_once("../../../controllers/Setting.php");
require_once("../../../controllers/Produk.php");
require_once("../../../controllers/Kategori.php");
require_once("../../../controllers/Pembayaran.php");
# require_once("../../../controllers/Admin.php");
# data akses folder to files
# $data = new controller\Setting($koneksi);
$auth = new controller\Authentication($koneksi);
$files = new controller\Pengguna($koneksi);
$produk = new controller\Produk($koneksi);
$kategori = new controller\Kategori($koneksi);
$payment = new controller\Pembayaran($koneksi);
# $admin = new controller\Admin($koneksi);

# Page / Halaman
if (!isset($_GET['page'])) {
} else {
    switch ($_GET['page']) {
        case 'beranda':
            $judul = $row['nama_website'] . " - Dashboard";
            require_once("../dashboard/index.php");
            break;

        case 'beli':
            $judul = $row['nama_website'] . " - Beli Produk";
            require_once("../pembelian/beli.php");
            break;

        case 'detail':
            $judul = $row['nama_website'] . " - Detail Produk";
            require_once("../pembelian/detail.php");
            break;

        case 'keranjang':
            $judul = $row['nama_website'] . " - Keranjang Produk";
            require_once("../pembelian/keranjang.php");
            break;

        case 'checkout':
            $judul = $row['nama_website'] . " - Checkout Keranjang";
            require_once("../pembelian/checkout.php");
            break;

        case 'nota':
            $judul = $row['nama_website'] . " - Nota Keranjang";
            require_once("../pembelian/nota.php");
            break;

        case 'pembayaran':
            $judul = $row['nama_website'] . " - pembayaran keranjang";
            require_once("../pembelian/pembayaran.php");
            break;

        case 'riwayat':
            $judul = $row['nama_website'] . " - Riwayat";
            require_once("../histori/riwayat.php");
            break;

        case 'lihat_pembayaran':
            $judul = $row['nama_website'] . " - Lihat Pembayaran";
            require_once("../pembelian/lihat_pembayaran.php");
            break;

        case 'logout':
            if (isset($_SESSION['status'])) {
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../index.php");
            exit(0);
            break;

        default:
            require_once("../dashboard/index.php");
            break;
    }
}

# Aksi / Action
if (!isset($_GET['aksi'])) {
} else {
    switch ($_GET['aksi']) {
        case 'checkout':
            $payment->setCheckout();
            break;

        case 'bayar':
            $payment->bukti();
            break;

        case 'hapus':
            $id_produk = $_GET["id"];
            unset($_SESSION["keranjang"][$id_produk]);
            echo "<script>alert('Produk Telah Dihapus');</script>";
            echo "<script>location='?page=keranjang';</script>";
            break;

        default:
            # code...
            break;
    }
}
