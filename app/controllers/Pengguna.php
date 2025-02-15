<?php

namespace controller;

use model\Pengguna_model;

class Pengguna
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Pengguna_model($konfig);
    }

    public function Daftar()
    {
        if (isset($_POST['submit'])):
            $email = htmlspecialchars($_POST['email_pelanggan']);
            $password = md5($_POST['password'], false);
            $nama = htmlspecialchars($_POST['nama_pelanggan']);
            $telepon = htmlspecialchars($_POST['telepon']);
            $alamat = htmlspecialchars($_POST['alamat_pelanggan']);
            $data = $this->konfig->setDaftarPengguna($email, $password, $nama, $telepon, $alamat);
            if ($data === true):
                echo "<script>document.location.href = 'index.php';</script>";
                die;
            else:
                echo "<script>document.location.href = 'regist.php';</script>";
                die;
            endif;
        endif;
    }

    public function setEdit()
    {
        if (isset($_POST['submitEdit'])) {
            $email = htmlspecialchars($_POST['email_pelanggan']);
            $nama = htmlspecialchars($_POST['nama_pelanggan']);
            $telepon = htmlspecialchars($_POST['telepon']);
            $alamat = htmlspecialchars($_POST['alamat_pelanggan']);
            $id = htmlspecialchars($_POST['id_pelanggan']);
            $data = $this->konfig->setEditPengguna($email, $nama, $telepon, $alamat, $id);
            if ($data === true):
                echo "<script>document.location.href = '../ui/header.php?page=user-profile&pelanggan=$id';</script>";
                die;
            else:
                echo "<script>document.location.href = '../ui/header.php?page=user-profile&pelanggan=$id&data=$id';</script>";
                die;
            endif;
        }
    }

    public function hapus()
    {
        $id = htmlspecialchars($_GET['id_pelanggan']);
        $data = $this->konfig->setHapusPelanggan($id);
        if ($data === true):
            $halaman = URL_BASE2 . "ui/header.php?page=pelanggan";
            echo "<script>document.location.href = '$halaman';</script>";
            die;
        else:
            $halaman2 = URL_BASE2 . "ui/header.php?page=pelanggan";
            echo "<script>document.location.href = '$halaman2';</script>";
            die;
        endif;
    }

    public function editpassword()
    {
        if (isset($_POST['submitPassword'])) {
            $new_password = md5(htmlspecialchars($_POST['new_password']), false);
            $id = htmlspecialchars($_POST['id_pelanggan']);
            $data = $this->konfig->setEditPassword($new_password, $id);
            if ($data === true):
                echo "<script>document.location.href = 'location:../ui/header.php?page=user-profile&pelanggan=$id';</script>";
                die;
            else:
                echo "<script>document.location.href = '../ui/header.php?page=user-profile&pelanggan=$id&change=$id';</script>";
                die;
            endif;
        }
    }
}