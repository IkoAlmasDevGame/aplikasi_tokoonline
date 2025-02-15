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
