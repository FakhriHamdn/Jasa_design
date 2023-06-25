<?php
session_start();

if (isset($_POST['barang_submit'])) {
    var_dump($_POST);
    var_dump($_FILES); die;
    $image = $_POST['upload_image'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    $_SESSION['imple_image'][] = [
        'image' => $image, 
        'nama_barang' => $nama_barang, 
        'harga' => $harga
    ];
    // var_dump($_SESSION['imple_image']);
    // exit;


    header("location: home.php");
    exit();
}

if(isset($_GET['delete_imple'])){
    $key_delete = $_GET['delete_imple'];

    unset($_SESSION['imple_image'][$key_delete]);
    header("Location: home.php?message=data berhasil dihapus");
}








?>