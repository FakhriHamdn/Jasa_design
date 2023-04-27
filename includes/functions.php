<?php
require 'connect.php';
$conn = new myConnection();
$getConnect = $conn->getConnection();


// function registerUser(){
//     global $getConnect;
//     $firstName = $_POST['firstname'];
//     $lastName = $_POST['lastname'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $confirmPass = $_POST['cpassword'];

//     $result = mysqli_query($getConnect, "SELECT * FROM users WHERE")

    





// }


function getDatas($query){
    global $getConnect;
    $result = mysqli_query($getConnect, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}



function getDataJasa() {
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM tb_jasa");
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function getDataKlien() {
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM tb_klien");
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function getDataTransaksi(){
    global $getConnect;
    $query = "SELECT tb_transaksi.id_transaksi, 
            tb_klien.nama_klien, 
            tb_jasa.nama_jasa, 
            tb_transaksi.tanggal, 
            tb_transaksi.jumlah_jasa, 
            tb_jasa.harga, 
            tb_transaksi.total_pembayaran
            FROM tb_klien INNER JOIN tb_transaksi ON tb_klien.id_klien = tb_transaksi.id_klien INNER JOIN tb_jasa ON tb_jasa.id_jasa = tb_transaksi.id_jasa";
    $result = mysqli_query($getConnect, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function getDataUsers() {
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM users");
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}












?>