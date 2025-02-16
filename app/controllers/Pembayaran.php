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

    public function bukti()
    {
        if (isset($_POST['kirim'])):
            $nama = htmlspecialchars($_POST['nama']);
            $bank = htmlspecialchars($_POST['bank']);
            $jumlah = htmlspecialchars($_POST['jumlah']);
            $id = htmlspecialchars($_POST['id_pembelian']);
            $data = $this->konfig->buktipembayaran($nama, $bank, $jumlah, $id);
            if ($data === true) {
                echo "<script>location = '?page=riwayat';</script>";
                die;
            } else {
                echo "<script>location = '?page=pembayaran&id=$id';</script>";
                die;
            }
        endif;
    }

    public function setCheckout()
    {
        if (isset($_POST['checkout'])):
            $id_pelanggan = $_POST['id_pelanggan'];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];
            $data = $this->konfig->checkout($id_pelanggan, $id_ongkir, $tanggal_pembelian, $alamat_pengiriman);
            if ($data === true) {
                return true;
            } else {
                return false;
            }
        endif;
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
