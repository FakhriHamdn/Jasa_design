<?php
session_start();

if (isset($_POST['barang_submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    $result = [$nama_barang, $harga];

    if (!isset($_SESSION['request'])) {
        $_SESSION['request'] = [];
    }

    $_SESSION['request'][] = $result;

    header("location: home.php");
    exit();
}








?>