<?php

namespace controller;

use model\Pembayaran_model;

class Pembayaran
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Pembayaran_model($konfig);
    }

    public function TargetUpdate()
    {
        if (isset($_POST['proses'])):
            $id = htmlspecialchars($_POST['id_pembelian']);
            $resi = htmlspecialchars($_POST["resi"]);
            $status = htmlspecialchars($_POST["status"]);
            $data = $this->konfig->UpdatePembayaran($resi, $status, $id);
            if ($data === true):
                echo "<script>alert('Data Pembelian Terupdate');</script>";
                $halaman = URL_BASE2 . "ui/header.php?page=pembelian";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            else:
                echo "<script>alert('Data Pembelian Tidak Terupdate');</script>";
                $halaman = URL_BASE2 . "ui/header.php?page=pembayaran&id=$id";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            endif;
        endif;
    }
}
