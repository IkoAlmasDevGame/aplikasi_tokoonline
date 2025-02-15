<?php

namespace controller;

use model\Produk_model;

class Produk
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Produk_model($konfig);
    }

    public function tambah()
    {
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $id_kategori = htmlspecialchars($_POST['id_kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $berat = htmlspecialchars($_POST['berat']);
            $jenis = htmlspecialchars($_POST['jenis']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);
            $stok = htmlspecialchars($_POST['stok']);
            $data = $this->konfig->tambahproduk($nama, $id_kategori, $harga, $berat, $jenis, $deskripsi, $stok);
            if ($data === true):
                $halaman = URL_BASE2 . "ui/header.php?page=produk";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                $halaman2 = URL_BASE2 . "ui/header.php?aksi=tambahproduk";
                echo "<script>document.location.href = '$halaman2';</script>";
                die;
            endif;
        }
    }

    public function ubah()
    {
        if (isset($_POST['ubahSimpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $id_kategori = htmlspecialchars($_POST['id_kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $berat = htmlspecialchars($_POST['berat']);
            $jenis = htmlspecialchars($_POST['jenis']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);
            $id = htmlspecialchars($_POST['id_produk']);
            $data = $this->konfig->editProduk($nama, $id_kategori, $harga, $berat, $jenis, $deskripsi, $id);
            if ($data === true):
                $halaman = URL_BASE2 . "ui/header.php?page=produk";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                $halaman2 = URL_BASE2 . "ui/header.php?aksi=produk-edit&id_produk=$id";
                echo "<script>document.location.href = '$halaman2';</script>";
                die;
            endif;
        }
    }

    public function stock()
    {
        if (isset($_POST['ubahStock'])) {
            $stokbaru = htmlspecialchars($_POST['stokbaru']);
            $id = htmlspecialchars($_POST['id_produk']);
            $data = $this->konfig->editStokProduk($stokbaru, $id);
            if ($data === true):
                $halaman = URL_BASE2 . "ui/header.php?page=produk";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                $halaman2 = URL_BASE2 . "ui/header.php?page=produk&stok=yes";
                echo "<script>document.location.href = '$halaman2';</script>";
                die;
            endif;
        }
    }

    public function hapus()
    {
        $id = htmlspecialchars($_GET['id_produk']);
        $data = $this->konfig->hapusProduk($id);
        if ($data === true):
            $halaman = URL_BASE2 . "ui/header.php?page=produk";
            echo "<script>document.location.href = '$halaman';</script>";
            die;
        else:
            $halaman2 = URL_BASE2 . "ui/header.php?page=produk";
            echo "<script>document.location.href = '$halaman2';</script>";
            die;
        endif;
    }
}