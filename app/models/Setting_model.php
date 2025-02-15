<?php

namespace model;

use core\Database;

class Setting_model
{
    protected $table = "setting";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBySetting()
    {
        return $this->db->query("SELECT * FROM $this->table");
    }

    public function setSetting($nama, $status, $id)
    {
        $nama = htmlspecialchars($_POST['nama_website']);
        $status = htmlspecialchars($_POST['status']);
        $id = htmlspecialchars($_POST['id_setting']);
        $ganti = isset($_POST['ganti']);
        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["foto_icon"]["name"]) ? htmlspecialchars($_FILES["foto_icon"]["name"]) : $_FILES["foto_icon"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto_icon']['size'];
        $file_tmp_photo_src = $_FILES['foto_icon']['tmp_name'];

        # selection Foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto_icon/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # Foto Section idUSer atau username pengguna
        $SQL = "SELECT * FROM $this->table WHERE id_setting = '$id'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        $berhasil = "data berhasil diubah";
        $gagal = "data gagal diubah";

        # result cek database
        if ($row['id_setting'] > 0) {
            if ($ganti) {
                if ($row['foto_icon'] == "") {
                    $update = "UPDATE $this->table SET nama_website = '$nama', status = '$status', foto_icon = '$photo_src' WHERE id_setting = '$id'";
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
                } elseif ($row['foto_icon'] != "") {
                    if ($photo_src != "") {
                        $update = "UPDATE $this->table SET nama_website = '$nama', status = '$status', foto_icon = '$photo_src' WHERE id_setting = '$id'";
                        $data = $this->db->query($update);
                        unlink("../../../../assets/foto_icon/$row[foto_icon]");
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
}
