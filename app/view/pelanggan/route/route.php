<?php
# pengambilan database di config
require_once("../../../init.php");
$SQL = "SELECT * FROM setting"; # bisa di isi untuk pengambilan nama website atau settingan webiste
$setting = $koneksi->query($SQL);
$row = mysqli_fetch_array($setting);
# session
if (isset($_SESSION['status'])) {
    if (isset($_SESSION['pelanggan'])) {
        if (isset($_SESSION['pelanggan_email'])) {
            if (isset($_SESSION['pelanggan_nama'])) {
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
        case 'value':
            # code...
            break;

        default:
            # code...
            break;
    }
}