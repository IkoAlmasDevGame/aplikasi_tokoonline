<?php
# code Library Salam
date_default_timezone_set("Asia/Jakarta");
function salam()
{
    $b = time();
    $hour = date("G", $b);

    if ($hour >= 0 && $hour <= 11) {
        echo "Selamat Pagi";
    } elseif ($hour >= 11 && $hour <= 15) {
        echo "Selamat Siang ";
    } elseif ($hour >= 15 && $hour <= 17) {
        echo "Selamat Sore ";
    } elseif ($hour >= 18 && $hour < 24) {
        echo "Selamat Malam ";
    }
}

# database anda
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_DATABASE = "db_tokoonline";
$koneksi = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE) or mysqli_connect_errno();

// define("DB_HOST", "localhost");
// define("DB_USER", "root");
// define("DB_PASS", "");
// define("DB_DATABASE", "db_tokoonline");

# Capthca
$min_number = 1;
$max_number = 15;
$angka1 = mt_rand($min_number, $max_number);
$angka2 = mt_rand($min_number, $max_number);
