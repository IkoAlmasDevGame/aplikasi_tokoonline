<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$base = "aplikasi_tokoonline"; # sebuah folder untuk menuju file index.php utama
$uri .= $_SERVER['HTTP_HOST'];
header('Location: ' . $uri . '/' . $base . '/app/view/index.php');
exit(0);