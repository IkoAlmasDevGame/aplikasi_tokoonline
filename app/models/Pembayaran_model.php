<?php

namespace model;

class Pembayaran_model
{
    protected $table = "pembayaran";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function buktipembayaran($nama, $bank, $jumlah, $id)
    {
        $nama = htmlspecialchars($_POST['nama']);
        $bank = htmlspecialchars($_POST['bank']);
        $jumlah = htmlspecialchars($_POST['jumlah']);
        $id = htmlspecialchars($_POST['id_pembelian']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = $_FILES["bukti"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['bukti']['size'];
        $file_tmp_photo_src = $_FILES['bukti']['tmp_name'];
        $tanggal = date("Y-m-d");

        # Validasi ekstensi dan ukuran foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/bukti_pembayaran/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        $berhasil = "Terima Kasih Telah Melakukan Pembayaran";
        $gagal = "Anda gagal melakukan transaksi pembayaran";

        $insert = "INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti) 
        VALUES('$id', '$nama', '$bank', '$jumlah', '$tanggal', '$photo_src')";
        $data = $this->db->query($insert);
        if ($data != "") {
            if ($data) {
                $this->db->query("UPDATE pembelian SET status_pembelian='berhasil' WHERE id_pembelian='$id'");
                echo "<script>alert('$berhasil');</script>";
                return true;
            }
        } else {
            echo "<script>alert('$gagal');</script>";
            return false;
        }
    }

    public function checkout($id_pelanggan, $id_ongkir, $tanggal_pembelian, $alamat_pengiriman)
    {
        $id_pelanggan = $_POST['id_pelanggan'];
        $id_ongkir = $_POST["id_ongkir"];
        $tanggal_pembelian = date("Y-m-d");
        $alamat_pengiriman = $_POST['alamat_pengiriman'];
        $totalbelanja = (int)$_POST['total_belanja'];

        $ambil = $this->db->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
        $arrayongkir = $ambil->fetch_assoc();
        $nama_kota = $arrayongkir['nama_kota'];
        $tarif = $arrayongkir['tarif'];
        $total_pembelian = $totalbelanja + $tarif;

        //1. menyimpan data ke tabel pembelian
        $this->db->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman)
		VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");
        //mendapatkan id_pembelian barusan terjadi
        $id_pembelian_barusan = $this->db->insert_id;
        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
            //mendapatkan data produk berdasarkan id_produk
            $ambil = $this->db->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $perproduk = $ambil->fetch_assoc();
            $nama = $perproduk['nama_produk'];
            $harga = $perproduk['harga_produk'];
            $berat = $perproduk['berat_produk'];
            $subberat = $perproduk['berat_produk'] * (int)$jumlah;
            $subharga = $perproduk['harga_produk'] * (int)$jumlah;
            $this->db->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah) VALUES ('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah')");
        }
        unset($_SESSION["keranjang"]);
        echo "<script>alert('Pembelian Berhasil');</script>";
        echo "<script>document.location.href='?page=nota&id=$id_pembelian_barusan';</script>";
    }

    public function UpdatePembayaran($resi, $status, $id)
    {
        $id = htmlspecialchars($_POST['id_pembelian']);
        $resi = htmlspecialchars($_POST["resi"]);
        $status = htmlspecialchars($_POST["status"]);
        $update = "UPDATE $this->table SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian='$id'";
        $data = $this->db->query($update);
        if ($data != null) {
            if ($data) {
                return true;
            }
        } else {
            return false;
        }
    }
}
