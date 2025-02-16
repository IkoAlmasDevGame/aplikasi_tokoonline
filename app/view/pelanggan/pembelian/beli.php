<?php
session_start();

$id_produk = $_GET['id'];
if (isset($_SESSION['keranjang'][$id_produk]['pelanggan_nama'])) {
   $_SESSION['keranjang'][$id_produk]['pelanggan_nama'] += 1;
} else {
   $_SESSION['keranjang'][$id_produk]['pelanggan_nama'] = 1;
}
echo "<script>alert('Produk Masuk ke Keranjang Belanja');</script>";
echo "<script>location='?page=keranjang';</script>";
