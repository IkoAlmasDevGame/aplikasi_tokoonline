<?php

namespace model;

class Kategori_model
{
    protected $table = "kategori";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ListKategori()
    {
        return $this->db->query("SELECT * FROM kategori order by id_kategori asc");
    }

    public function tambahkategori($nama_kategori)
    {
        $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
        $sql = "SELECT * FROM $this->table WHERE nama_kategori = '$nama_kategori' order by nama_kategori desc";
        $result = $this->db->query($sql);
        $row = mysqli_num_rows($result);

        $berhasil = "berhasil menambahkan kategori baru.";
        $gagal = "gagal menambahkan kategori baru.";

        if ($row) {
            header("location:../ui/header.php?page=kategori");
            exit(0);
        } else {
            $insert = "INSERT INTO $this->table SET nama_kategori = '$nama_kategori'";
            $data = $this->db->query($insert);
            if ($data != null) {
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

    public function editkategori($nama_kategori, $id)
    {
        $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
        $id = htmlspecialchars($_POST['id_kategori']);
        $update = "UPDATE $this->table SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id'";
        $data = $this->db->query($update);

        $berhasil = "berhasil mengubah kategori baru.";
        $gagal = "gagal mengubah kategori baru.";

        if ($data != null) {
            if ($data) {
                echo "<script>alert('$berhasil');</script>";
                return true;
            }
        } else {
            echo "<script>alert('$gagal');</script>";
            return false;
        }
    }

    public function hapuskategori($id)
    {
        $id = htmlspecialchars($_GET['id_kategori']);
        $update = "DELETE FROM $this->table WHERE id_kategori = '$id'";
        $data = $this->db->query($update);

        $berhasil = "berhasil menghapus kategori baru.";
        $gagal = "gagal menghapus kategori baru.";

        if ($data != null) {
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