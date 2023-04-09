<?php 
require 'Connection.php';
$add_access = new adminAccess();
$aksi = $_GET['action'];

if($aksi == "insert_services") {
    $result = $add_access->insertServices($_POST['nama_jasa'], $_POST['harga']);
    if ($result) {
        header("location:data_jasa.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "update_services") {
    $result = $add_access->editServices($_POST['id_jasa'], $_POST['nama_jasa'], $_POST['harga']);
    if ($result) {
        header("location:data_jasa.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "delete_service") {
    $result = $add_access->deleteServices($_GET['id_jasa']);
    if ($result) {
        header("location:data_jasa.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "insertCustomer") {
    $result = $add_access->insertCustomer($_POST['nama_klien'], $_POST['alamat'], $_POST['no_telp'], $_POST['email']);
    if ($result) {
        header("location:data_klien.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "update_klien") {
    $result = $add_access->editCustomer($_POST['id_klien'], $_POST['nama_klien'], $_POST['alamat'], $_POST['no_telp'], $_POST['email']);
    if ($result) {
        header("location:data_klien.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == 'delete_klienID') {
    $result = $add_access->deleteCustomer($_GET['id_klien']);
    if ($result) {
        header("location:data_klien.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "insertTransactions") {
    $id_jasa = $_POST['id_jasa'];
    $row = $add_access->getHargaJasa($id_jasa);
    $harga = $row['harga'];
    $total_pembayaran = $harga * $_POST['jumlah_jasa'];
    $result = $add_access->insertTransactions($_POST["id_klien"], $_POST["id_jasa"], $_POST["tanggal"], 
    $_POST["jumlah_jasa"], $harga, $total_pembayaran);
    if ($result) {
        header("location:data_transaksi.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "update_transactions") {
    $id_jasa = $_POST['id_jasa'];
    $row = $add_access->getHargaJasa($id_jasa);
    $harga = $row['harga'];
    $total_pembayaran = $harga * $_POST['jumlah_jasa'];
    $result = $add_access->editTransactions($_POST['id_transaksi'], $_POST["id_klien"], $_POST["id_jasa"], $_POST["tanggal"], $_POST["jumlah_jasa"], $harga, $total_pembayaran);
    if ($result) {
        header("location:data_transaksi.php");
    } else {
        header("location:error.php");
    }
} else if($aksi == "delete_transactions") {
    $result = $add_access->deleteTransactions($_GET['id_transaksi']);
    if ($result) {
        header("location:data_transaksi.php");
    }
}
