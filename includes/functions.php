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

function updateProduct($id_product, $nama_product, $harga){
    global $getConnect;
    
    $query = "UPDATE products SET nama_product = ?, harga = ? WHERE id_product = ?";
    $stmt = mysqli_prepare($getConnect, $query);
    mysqli_stmt_bind_param($stmt, 'sii', $nama_product, $harga, $id_product);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($getConnect);
  }

  function getDataById($table, $id) {
    global $getConnect;
    $query = "SELECT * FROM $table WHERE id_product = $id";
    $result = mysqli_query($getConnect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

  






?>