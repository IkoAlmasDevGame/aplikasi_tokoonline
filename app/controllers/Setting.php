<?php

namespace controller;

use model\Setting_model;

class Setting
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Setting_model($konfig);
    }

    public function BySettingData()
    {
        return $this->konfig->getBySetting();
    }

    public function setEdit()
    {
        if (isset($_POST['submit'])) {
            $nama = htmlspecialchars($_POST['nama_website']);
            $status = htmlspecialchars($_POST['status']);
            $id = htmlspecialchars($_POST['id_setting']);
            $change = $this->konfig->setSetting($nama, $status, $id);
            if ($change != "") {
                if ($change) {
                    $halaman = URL_BASE2 . "ui/header.php?page=setting&id_setting=$id";
                    echo "<script>document.location.href = '$halaman';</script>";
                    die;
                }
            } else {
                $halaman = URL_BASE2 . "ui/header.php?page=setting&id_setting=$id";
                echo "<script>document.location.href = '$halaman';</script>";
                die;
            }
        }
    }
}
