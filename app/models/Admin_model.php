<?php

namespace model;

class Admin_model
{
    protected $table = "admin";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function edit($id_adm)
    {
        $SQL = "SELECT * FROM $this->table WHERE id_admin = '$id_adm'";
        return $this->db->query($SQL);
    }

    public function setEditAdmin($username, $nama, $email, $id)
    {
        $username = htmlspecialchars($_POST['username']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $email = htmlspecialchars($_POST['email_admin']);
        $id = htmlspecialchars($_POST['id_admin']);
        $ganti = isset($_POST['ganti']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = $_FILES["foto_admin"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto_admin']['size'];
        $file_tmp_photo_src = $_FILES['foto_admin']['tmp_name'];

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
        $SQL = "SELECT * FROM $this->table WHERE id_admin = '$id'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        $berhasil = "Selamat anda sudah berhasil mengubah identitas anda menjadi lebih baru lagi.";
        $gagal = "Anda gagal mengubah identitas anda.";

        # data files row pada database
        if ($row['id_admin'] > 0) {
            if ($ganti) {
                if ($row['foto_admin'] == "") {
                    $update = "UPDATE $this->table SET username = '$username', nama_lengkap = '$nama', email_admin = '$email', foto_admin = '$photo_src' WHERE id_admin = '$id'";
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
                } elseif ($row['foto_admin'] != "") {
                    if ($photo_src != "") {
                        unlink("../../../../assets/foto/$row[foto_admin]");
                        $update = "UPDATE $this->table SET username = '$username', nama_lengkap = '$nama', email_admin = '$email', foto_admin = '$photo_src' WHERE id_admin = '$id'";
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
        $id = htmlspecialchars($_POST['id_admin']);
        # database password
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE id_admin = '$id'");
        $row = mysqli_fetch_array($mysql);
        # cek update password
        if (password_verify($old_password, PASSWORD_DEFAULT) == md5($row['password'], false)) {
            header("location:../ui/header.php?page=profile&id_admin=$id&change=$id");
            exit(0);
        }

        $berhasil = "Anda berhasil mengubah password lama menjadi password baru.";
        $gagal = "Anda gagal mengubah passowrd lama anda menjadi password baru.";

        # change password yang terbaru ...
        if ($new_password == $new_password_verify) {
            $SQL = "UPDATE $this->table SET password = '$new_password' WHERE id_admin = '$id'";
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
}
