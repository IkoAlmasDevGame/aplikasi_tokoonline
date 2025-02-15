<?php

namespace model;

class Pengguna_model
{
    protected $table = "pelanggan";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ListPelanggan()
    {
        return $this->db->query("SELECT * FROM $this->table order by id_pelanggan asc");
    }

    public function setHapusPelanggan($id)
    {
        $id = htmlspecialchars($_GET['id_pelanggan']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE id_pelanggan = '$id'");
        $array = mysqli_fetch_array($select);
        $foto = $array["gambar"];

        $berhasil = "Produk Berhasil dihapus.";
        $gagal = "Produk Gagal dihapus.";

        if ($array["gambar"] == "") {
            $delete = "DELETE FROM $this->table WHERE id_pelanggan = '$id'";
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
            unlink("../../../../assets/foto/$foto");
            $data = $this->db->query("DELETE FROM $this->table WHERE id_pelanggan = '$id'");
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

    public function setEditPengguna($email, $nama, $telepon, $alamat, $id)
    {
        $email = htmlspecialchars($_POST['email_pelanggan']);
        $nama = htmlspecialchars($_POST['nama_pelanggan']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $alamat = htmlspecialchars($_POST['alamat_pelanggan']);
        $id = htmlspecialchars($_POST['id_pelanggan']);
        $ganti = isset($_POST['ganti']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = $_FILES["gambar"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['gambar']['size'];
        $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];

        # Validasi ekstensi dan ukuran foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # files database pelanggan
        $SQL = "SELECT * FROM $this->table WHERE id_pelanggan = '$id'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        $berhasil = "Selamat anda sudah berhasil mengubah identitas anda menjadi lebih baru lagi.";
        $gagal = "Anda gagal mengubah identitas anda.";

        # data files row pada database
        if ($row['id_pelanggan'] > 0) {
            if ($ganti) {
                if ($row['gambar'] == "") {
                    $update = "UPDATE $this->table SET email_pelanggan = '$email', nama_pelanggan = '$nama', telepon = '$telepon', 
                    alamat_pelanggan = '$alamat', gambar = '$photo_src', size = '$ukuran_photo_src' WHERE id_pelanggan = '$id'";
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
                } elseif ($row['gambar'] != "") {
                    if ($photo_src != "") {
                        unlink("../../../../assets/foto/$row[gambar]");
                        $update = "UPDATE $this->table SET email_pelanggan = '$email', nama_pelanggan = '$nama', telepon = '$telepon', 
                        alamat_pelanggan = '$alamat', gambar = '$photo_src', size = '$ukuran_photo_src' WHERE id_pelanggan = '$id'";
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

    public function setEditPassword($new_password, $id)
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $old_password = md5(htmlspecialchars($_POST['old_password']), false);
        $new_password_verify = md5(htmlspecialchars($_POST['new_password_verify']), false);
        $id = htmlspecialchars($_POST['id_pelanggan']);
        # database password
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE id_pelanggan = '$id'");
        $row = mysqli_fetch_array($mysql);
        # cek update password
        if (password_verify($old_password, PASSWORD_DEFAULT) == md5($row['password'], false)) {
            header("location:../ui/header.php?page=user-profile&pelanggan=$id&change=$id");
            exit(0);
        }

        $berhasil = "Anda berhasil mengubah password lama menjadi password baru.";
        $gagal = "Anda gagal mengubah passowrd lama anda menjadi password baru.";

        # change password yang terbaru ...
        if ($new_password == $new_password_verify) {
            $SQL = "UPDATE $this->table SET password = '$new_password' WHERE id = '$id'";
            $data = $this->db->query($SQL);
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

    public function setDaftarPengguna($email, $password, $nama, $telepon, $alamat)
    {
        if (empty($_POST['email_pelanggan']) || empty(md5($_POST['password'], false)) || empty($_POST['nama_pelanggan']) || empty($_POST['telepon']) || empty($_POST['alamat_pelanggan'])):
            header("location:regist.php");
            exit(0);
        else:
            $email = htmlspecialchars($_POST['email_pelanggan']);
            $password = md5($_POST['password'], false);
            $nama = htmlspecialchars($_POST['nama_pelanggan']);
            $telepon = htmlspecialchars($_POST['telepon']);
            $alamat = htmlspecialchars($_POST['alamat_pelanggan']);
            # Foto 
            $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
            $photo_src = $_FILES["gambar"]["name"];
            $x_foto = explode('.', $photo_src);
            $ekstensi_photo_src = strtolower(end($x_foto));
            $ukuran_photo_src = $_FILES['gambar']['size'];
            $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];

            // Validasi ekstensi dan ukuran foto
            if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
                if ($ukuran_photo_src < 10440070) {
                    move_uploaded_file($file_tmp_photo_src, "../../assets/foto/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit(0);
                }
            } else {
                echo "Tidak Dapat Ter-Upload Ke Dalam Database";
                exit(0);
            }

            $SQL = "SELECT * FROM $this->table WHERE email_pelanggan = '$email'";
            $result = $this->db->query($SQL);
            $row = mysqli_num_rows($result);

            if ($row > 0) {
                echo "<script>alert('Data email sudah ada ...'); document.location.href = 'regist.php';</script>";
                die;
            } else {
                $insert = "INSERT INTO $this->table SET email_pelanggan = '$email', password = '$password', nama_pelanggan = '$nama', telepon = '$telepon', 
                alamat_pelanggan = '$alamat', gambar = '$photo_src', size = '$ukuran_photo_src'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    if ($data) {
                        echo "<script>alert('Data Berhasil dibuat ...');</script>";
                        return true;
                    }
                } else {
                    echo "<script>alert('Data Gagal dibuat ...');</script>";
                    return false;
                }
            }
        endif;
    }
}
