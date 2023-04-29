<?php 
require 'functions.php';

//ACTION FOR INSERT & UPDATE PRODUCTS
if(isset($_POST['action'])) {
    $nama_product = htmlspecialchars($_POST['product']);
    $harga = htmlspecialchars($_POST['harga']);

    if($_POST['action'] === 'insertProduct') {
        $result = insertDataProduct($nama_product, $harga);
        if ($result) {
            $msg = "Product data has been successfully added";
            header("Location: ../admin2/data_product.php?message=" . urlencode($msg));
            exit();
        } else {
            header("Location: ../admin2/data_product.php");
        }

    } else if($_POST['action'] === 'editProduct' && isset($_POST['id_product'])) {
        $id_product = $_POST['id_product'];
        $row = getProductId($id_product);
        if($row){
            $result = updateDataProduct($id_product, $nama_product, $harga);            
            if($result){
                $msg = "Product data has been successfully updated";
                header("Location: ../admin2/data_product.php?message=" . urlencode($msg));
                exit();
            }
        }
    }
}
//END PRODUCTS

//ACTION FOR INSERT & UPDATE CUSTOMERS
if(isset($_POST['cust_submit'])){
    $nama_cust = htmlspecialchars($_POST['cust']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = strtolower(htmlspecialchars($_POST['email']));

    if($_GET['action'] === 'insertCustomer'){
        $result = insertCustomer($nama_cust, $alamat, $no_telp, $email);
        if($result){
            $msg = "Customer data has been successfully added";
            header("Location: ../admin2/data_cust.php?" . urlencode($msg));
            exit;
        } else {
            header("Location: ../admin2/data_product.php");
        }

    } else if($_GET['action'] === 'editCustomer'){
        $id_cust = $_POST['id_cust'];
        $row = getCustomerId($id_cust);
        if($row){
            $result = updateDataCustomer($id_cust, $nama_cust, $alamat, $no_telp, $email);
            if($result){
                $msg = "Customer data has been successfully updated";
                header("Location: ../admin2/data_cust.php?message=" . urlencode($msg));
                exit();
            }
        }
    }   
}
//END CUSTOMERS







//ACTION FOR DELETING DATAS
if(isset($_GET['id_delete'])) {
    if($_GET['page'] === 'product'){
        $id_product = $_GET['id_delete'];
        $result = deleteDataProduct($id_product);
        if($result){
            $msg = "Product data has been successfully deleted";
            header("Location: ../admin2/data_product.php?message=" . urlencode($msg));
            exit();
        }
    } else if($_GET['page'] === 'customer') {
        $id_cust = $_GET['id_delete'];
        $result = deleteDataCustomer($id_cust);
        if($result){
            $msg = "Customer data has been successfully deleted";
            header("Location: ../admin2/data_cust.php?message=" . urlencode($msg));
            exit();
        }
    }
}
//END DELETING DATAS
