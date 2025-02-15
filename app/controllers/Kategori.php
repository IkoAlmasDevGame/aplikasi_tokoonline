<?php

namespace controller;

use model\Kategori_model;

class Kategori
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Kategori_model($konfig);
    }

    public function tambah()
    {
        if (isset($_POST["simpan"])):
            $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
            $data = $this->konfig->tambahkategori($nama_kategori);
            if ($data === true):
                $halaman = URL_BASE2 . "ui/header.php?page=kategori";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                $halaman2 = URL_BASE2 . "ui/header.php?page=kategori";
                echo "<script>document.location.href = '$halaman2';</script>";
                die;
            endif;
        endif;
    }

    public function ubah()
    {
        if (isset($_POST["ubahSimpan"])) {
            $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
            $id = htmlspecialchars($_POST['id_kategori']);
            $data = $this->konfig->editkategori($nama_kategori, $id);
            if ($data === true):
                $halaman = URL_BASE2 . "ui/header.php?page=kategori";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                $halaman2 = URL_BASE2 . "ui/header.php?page=kategori";
                echo "<script>document.location.href = '$halaman2';</script>";
                die;
            endif;
        }
    }

    public function hapus()
    {
        $id = htmlspecialchars($_GET['id_kategori']);
        $data = $this->konfig->hapuskategori($id);
        if ($data === true):
            $halaman = URL_BASE2 . "ui/header.php?page=kategori";
            echo "<script>document.location.href = '$halaman';</script>";
            die;
        else:
            $halaman2 = URL_BASE2 . "ui/header.php?page=kategori";
            echo "<script>document.location.href = '$halaman2';</script>";
            die;
        endif;
    }
}
