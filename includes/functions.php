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

function insertDataProduct($nama_product, $harga){
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

function updateDataProduct($id_product, $nama_product, $harga) {
    global $getConnect;
    $query = "UPDATE products SET nama_product = '$nama_product', harga = '$harga' WHERE id_product = '$id_product'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function deleteDataProduct($id_product){
    global $getConnect;
    $query = "DELETE FROM products WHERE id_product = '$id_product'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function getCustomerId($id_cust){
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM customers WHERE id_cust = '$id_cust'");
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function insertCustomer($nama_cust, $alamat, $no_telp, $email){
    global $getConnect;
    $query = "INSERT INTO customers VALUES('', '$nama_cust', '$alamat', '$no_telp', '$email')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function updateDataCustomer($id_cust, $nama_cust, $alamat, $no_telp, $email){
    global $getConnect;
    $query = "UPDATE customers SET nama_cust = '$nama_cust', alamat = '$alamat', no_telp = '$no_telp', email = '$email' WHERE id_cust = '$id_cust'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function deleteDataCustomer($id_cust){
    global $getConnect;
    $query = "DELETE FROM customers WHERE id_cust = $id_cust";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function getTransactionId($id_transaction){
    global $getConnect;
    $query = "SELECT transactions.id_transaction, 
            customers.nama_cust, 
            products.nama_product, 
            transactions.tanggal, 
            transactions.jumlah_product, 
            products.harga, 
            transactions.total_pembayaran
            FROM customers INNER JOIN transactions ON customers.id_cust = transactions.id_cust INNER JOIN products ON products.id_product = transactions.id_product WHERE transactions.id_transaction = '$id_transaction'";
    $result = mysqli_query($getConnect, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}


function insertDataTransaction($id_cust, $id_product, $tanggal, $jumlah){
    global $getConnect;
    $query = "INSERT INTO transactions VALUES('', '$id_cust', '$id_product', '$tanggal', '$jumlah')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function deleteDataTransaction($id_transaction){
    global $getConnect;
    $query = "DELETE FROM transactions WHERE id_transaction = '$id_transaction'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}


?>