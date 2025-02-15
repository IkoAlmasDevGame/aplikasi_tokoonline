<?php

namespace controller;

use model\Admin_model;

class Admin
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Admin_model($konfig);
    }

    public function editBiodata()
    {
        if (isset($_POST['ubahData'])) {
            $username = htmlspecialchars($_POST['username']);
            $nama = htmlspecialchars($_POST['nama_lengkap']);
            $email = htmlspecialchars($_POST['email_admin']);
            $id = htmlspecialchars($_POST['id_admin']);
            $data = $this->konfig->setEditAdmin($username, $nama, $email, $id);
            if ($data === true):
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_admin=$id';</script>";
                die;
            else:
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_admin=$id&change=$id';</script>";
                die;
            endif;
        }
    }

    public function editpassword()
    {
        if (isset($_POST['submitPassword'])) {
            $new_password = md5(htmlspecialchars($_POST['new_password']), false);
            $id = htmlspecialchars($_POST['id_admin']);
            $data = $this->konfig->setEditPassword($new_password, $id);
            if ($data === true):
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_admin=$id';</script>";
                die;
            else:
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_admin=$id&change=$id';</script>";
                die;
            endif;
        }
    }
}
