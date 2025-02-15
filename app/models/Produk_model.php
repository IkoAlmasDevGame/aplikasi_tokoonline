<?php

namespace model;

class Produk_model
{
    protected $table = "produk";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ListProduk()
    {
        $sql = "SELECT * FROM $this->table JOIN kategori ON produk.id_kategori = kategori.id_kategori order by produk.id_produk asc";
        return $this->db->query($sql);
    }

    public function ListProdukStok()
    {
        $sql = "SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.stok_produk <= '3' order by produk.id_produk asc";
        return $this->db->query($sql);
    }

    public function ListEditProduk($id)
    {
        $sql = "SELECT * FROM $this->table JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_produk = '$id' order by produk.id_produk asc";
        return $this->db->query($sql);
    }


    public function tambahproduk($nama, $id_kategori, $harga, $berat, $jenis, $deskripsi, $stok)
    {
        if (empty($_POST['nama']) || empty($_POST['id_kategori']) || empty($_POST['harga']) || empty($_POST['berat']) || empty($_POST['deskripsi']) || empty($_POST['stok'])):
            header("Location:../ui/header.php?aksi=tambahproduk");
            exit(0);
        else:
            $nama = htmlspecialchars($_POST['nama']);
            $id_kategori = htmlspecialchars($_POST['id_kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $berat = htmlspecialchars($_POST['berat']);
            $jenis = htmlspecialchars($_POST['jenis']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);
            $stok = htmlspecialchars($_POST['stok']);
            # Foto 
            $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
            $photo_src = $_FILES["foto"]["name"];
            $x_foto = explode('.', $photo_src);
            $ekstensi_photo_src = strtolower(end($x_foto));
            $ukuran_photo_src = $_FILES['foto']['size'];
            $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

            # Validasi ekstensi dan ukuran foto
            if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
                if ($ukuran_photo_src < 10440070) {
                    move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto_produk/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit(0);
                }
            } else {
                echo "Tidak Dapat Ter-Upload Ke Dalam Database";
                exit(0);
            }

            # files selection database
            $sql = "SELECT * FROM $this->table WHERE nama_produk = '$nama' order by nama_produk asc";
            $result = $this->db->query($sql);
            $row = mysqli_num_rows($result);

            $berhasil = "berhasil menambahkan data produk baru.";
            $gagal = "gagal menambahkan data produk baru.";

            # database files
            if ($row > 0) {
                unlink("../../../../assets/foto_produk/$photo_src");
                header("Location:../ui/header.php?aksi=tambahproduk");
                exit(0);
            } else {
                $insert = "INSERT INTO $this->table SET nama_produk = '$nama', id_kategori = '$id_kategori', harga_produk = '$harga', berat_produk = '$berat', jenis_berat = '$jenis',
                deskripsi_produk = '$deskripsi', foto_produk = '$photo_src', stok_produk = '$stok'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    if ($data) {
                        echo "<script>alert('$berhasil');</script>";
                        return true;
                    }
                } else {
                    echo "<script>alert('$gagal');</script>";
                    return false;
                }
            }
        endif;
    }

    public function editProduk($nama, $id_kategori, $harga, $berat, $jenis, $deskripsi, $id)
    {
        $nama = htmlspecialchars($_POST['nama']);
        $id_kategori = htmlspecialchars($_POST['id_kategori']);
        $harga = htmlspecialchars($_POST['harga']);
        $berat = htmlspecialchars($_POST['berat']);
        $jenis = htmlspecialchars($_POST['jenis']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        $ganti = isset($_POST['ganti']);
        $id = htmlspecialchars($_POST['id_produk']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = $_FILES["foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        # Validasi ekstensi dan ukuran foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto_produk/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # files selection database
        $sql = "SELECT * FROM $this->table WHERE id_produk = '$id'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_array($result);

        $berhasil = "anda berhasil mengubah data produk $nama ini.";
        $gagal = "anda gagal mengubah data produk $nama ini.";

        # database files
        if ($row['id_produk'] > 0) {
            if ($ganti) {
                if ($row['foto_produk'] == "") {
                    $update = "UPDATE $this->table SET nama_produk = '$nama', id_kategori = '$id_kategori', harga_produk = '$harga', berat_produk = '$berat', jenis_berat = '$jenis',
                    deskripsi_produk = '$deskripsi', foto_produk = '$photo_src' WHERE id_produk = '$id'";
                    $data = $this->db->query($update);
                    if ($data != "") {
                        if ($data) {
                            echo "<script>alert('$berhasil');</script>";
                            return true;
                        }
                    } else {
                        echo "<script>alert('$gagal');</script>";
                        return false;
                    }
                } elseif ($row['foto_produk'] != "") {
                    if ($photo_src != "") {
                        unlink("../../../../assets/foto_produk/$row[foto_produk]");
                        $update = "UPDATE $this->table SET nama_produk = '$nama', id_kategori = '$id_kategori', harga_produk = '$harga', berat_produk = '$berat', 
                        deskripsi_produk = '$deskripsi', foto_produk = '$photo_src' WHERE id_produk = '$id'";
                        $data = $this->db->query($update);
                        if ($data != "") {
                            if ($data) {
                                echo "<script>alert('$berhasil');</script>";
                                return true;
                            }
                        } else {
                            echo "<script>alert('$gagal');</script>";
                            return false;
                        }
                    }
                }
            }
        }
    }

    public function editStokProduk($stokbaru, $id)
    {
        $stokbaru = htmlspecialchars($_POST['stokbaru']);
        $id = htmlspecialchars($_POST['id_produk']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE id_produk = '$id'");
        $array = mysqli_fetch_array($select);
        $stok = $array['stok_produk'] + $stokbaru;

        $berhasil = "Berhasil mengubah data stock produk.";
        $gagal = "Gagal mengubah data stock produk.";

        if ($array['stok_produk'] == "") {
            $upStok = "UPDATE $this->table SET stok_produk = '$array[stok_produk]' WHERE id_produk = '$id'";
            $data = $this->db->query($upStok);
            if ($data != "") {
                if ($data) {
                    echo "<script>alert('$berhasil');</script>";
                    return true;
                }
            } else {
                echo "<script>alert('$gagal');</script>";
                return false;
            }
        } else {
            $upStok = "UPDATE $this->table SET stok_produk = '$stok' WHERE id_produk = '$id'";
            $data = $this->db->query($upStok);
            if ($data != "") {
                if ($data) {
                    echo "<script>alert('$berhasil');</script>";
                    return true;
                }
            } else {
                echo "<script>alert('$gagal');</script>";
                return false;
            }
        }
    }

    public function hapusProduk($id)
    {
        $id = htmlspecialchars($_GET['id_produk']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE id_produk = '$id'");
        $array = mysqli_fetch_array($select);
        $foto = $array["foto_produk"];

        $berhasil = "Produk Berhasil dihapus.";
        $gagal = "Produk Gagal dihapus.";

        if ($array["foto_produk"] == "") {
            $delete = "DELETE FROM $this->table WHERE id_produk = '$id'";
            $data = $this->db->query($delete);
            if ($data != "") {
                if ($data) {
                    echo "<script>alert('$berhasil');</script>";
                    return true;
                }
            } else {
                echo "<script>alert('$gagal');</script>";
                return false;
            }
        } else {
            unlink("../../../../assets/foto_produk/$foto");
            $data = $this->db->query("DELETE FROM $this->table WHERE id_produk = '$id'");
            if ($data != "") {
                if ($data) {
                    echo "<script>alert('$berhasil');</script>";
                    return true;
                }
            } else {
                echo "<script>alert('$gagal');</script>";
                return false;
            }
        }
    }
}