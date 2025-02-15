<?php
# pengambilan database di config
require_once("../../../init.php");
$SQL = "SELECT * FROM setting"; # bisa di isi untuk pengambilan nama website atau settingan webiste
$setting = $koneksi->query($SQL);
$row = mysqli_fetch_array($setting);
# session
if (isset($_SESSION['status'])) {
    if (isset($_SESSION['admin'])) {
        if (isset($_SESSION['email'])) {
            if (isset($_SESSION['username'])) {
                if (isset($_SESSION['name'])) {
                    if (isset($_SESSION['akses'])) {
                        if (isset($_COOKIE['cookies'])) {
                            if (isset($_SERVER['HTTP_ACCEPT'])) {
                                if (isset($_SERVER['REDIRECT_STATUS'])) {
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
require_once("../../../models/Setting_model.php");
require_once("../../../models/Produk_model.php");
require_once("../../../models/Kategori_model.php");
require_once("../../../models/Pembelian_model.php");
require_once("../../../models/Pembayaran_model.php");
require_once("../../../models/Admin_model.php");
$product = new model\Produk_model($koneksi);
$category = new model\Kategori_model($koneksi);
$pelanggan = new model\Pengguna_model($koneksi);
$pembelian = new model\Pembelian_model($koneksi);
$pembayaran = new model\Pembayaran_model($koneksi);
$adm = new model\Admin_model($koneksi);
# Folder Controller
require_once("../../../controllers/Authentication.php");
require_once("../../../controllers/Pengguna.php");
require_once("../../../controllers/Setting.php");
require_once("../../../controllers/Produk.php");
require_once("../../../controllers/Kategori.php");
require_once("../../../controllers/Pembayaran.php");
require_once("../../../controllers/Admin.php");
# data akses folder to files
$data = new controller\Setting($koneksi);
$auth = new controller\Authentication($koneksi);
$files = new controller\Pengguna($koneksi);
$produk = new controller\Produk($koneksi);
$kategori = new controller\Kategori($koneksi);
$payment = new controller\Pembayaran($koneksi);
$admin = new controller\Admin($koneksi);

# Page / Halaman
if (!isset($_GET['page'])) {
} else {
    switch ($_GET['page']) {
        case 'beranda':
            $judul = $row['nama_website'] . " - Dashboard";
            require_once("../dashboard/index.php");
            break;

        case 'produk':
            $judul = $row['nama_website'] . " - Produk";
            require_once("../produk/produk.php");
            break;

        case 'kategori':
            $judul = $row['nama_website'] . " - Kategori";
            require_once("../kategori/kategori.php");
            break;

        case 'pembelian':
            $judul = $row['nama_website'] . " - Pembelian";
            require_once("../pembelian/pembelian.php");
            break;

        case 'detail':
            $judul = $row['nama_website'] . " - Detail Pembelian";
            require_once("../pembelian/detail.php");
            break;

        case 'pembayaran':
            $judul = $row['nama_website'] . " - Pembayaran";
            require_once("../pembelian/pembayaran.php");
            break;

        case 'pelanggan':
            $judul = $row['nama_website'] . " - Pelanggan";
            require_once("../pelanggan/pelanggan.php");
            break;

        case 'laporan':
            $judul = $row['nama_website'] . " - Laporan Pembelian";
            require_once("../laporan/laporan_pembelian.php");
            break;

        case 'print-laporan':
            $judul = $row['nama_website'] . " - Print Laporan";
            require_once("../laporan/print.php");
            break;

        case 'setting':
            $judul = $row['nama_website'] . " - Setting Website";
            require_once("../setting/edit.php");
            break;

        case 'profile':
            $judul = $row['nama_website'] . " - Edit Profile";
            require_once("../profile/edit.php");
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
            # Halaman Produk
        case 'tambahproduk':
            $judul = $row["nama_website"] . " - Tambah List Product";
            require_once("../produk/tambah.php");
            break;
        case 'editproduk':
            $judul = $row["nama_website"] . " - Edit List Product";
            require_once("../produk/edit.php");
            break;
        case 'tambah-produk':
            $produk->tambah();
            break;
        case 'edit-produk':
            $produk->ubah();
            break;
        case 'update-stok':
            $produk->stock();
            break;
        case 'hapus-produk':
            $produk->hapus();
            break;
            # Halaman Produk

            # Halaman Kategori
        case 'tambah-kategori':
            $kategori->tambah();
            break;
        case 'edit-kategori':
            $kategori->ubah();
            break;
        case 'hapus-kategori':
            $kategori->hapus();
            break;
            # Halaman Kategori

            # Halaman Pelanggan
        case 'hapus-pelanggan':
            $files->hapus();
            break;
            # Halaman Pelanggan

            # Halaman Pembayaran
        case 'pembayaran-pelanggan':
            $payment->TargetUpdate();
            break;
            # Halaman Pembayaran

            # Halaman Setting
        case 'setting-edit':
            $data->setEdit();
            break;
            # Halaman Setting

            # Halaman Profile
        case 'perbarui-profile':
            $admin->editBiodata();
            break;
        case 'perbarui-password':
            $admin->editpassword();
            break;
            # Halaman Profile


        default:
            # code...
            break;
    }
}
