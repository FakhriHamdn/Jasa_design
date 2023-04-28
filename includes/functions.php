<?php
require 'connect.php';
$conn = new myConnection();
$getConnect = $conn->getConnection();
//END CONNECTION


function getDatas($query){
    global $getConnect;
    $result = mysqli_query($getConnect, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function insertDataJasa($nama_product, $harga){
    global $getConnect;
    $query = "INSERT INTO products VALUES('', '$nama_product', '$harga')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function getProductId($id_product){
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM products WHERE id_product = '$id_product'");
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function updateDataJasa($id_jasa, $produk, $harga) {
    global $getConnect;
    $query = "UPDATE tb_jasa SET nama_jasa = '$produk', harga = '$harga' WHERE id_jasa = '$id_jasa'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}








?>