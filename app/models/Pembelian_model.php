<?php

namespace model;

class Pembelian_model
{
    protected $table = "pembelian";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ListPembelian()
    {
        return $this->db->query("SELECT * FROM pembelian JOIN pelanggan on pembelian.id_pelanggan=pelanggan.id_pelanggan");
    }
}
