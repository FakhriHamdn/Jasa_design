<?php
require 'connect.php';
$conn = new myConnection();
$getConnect = $conn->getConnection();
//END CONNECTION

//================= FUNCTION SELECT DATA FROM DATABASE =================
function getDatas($query){
    global $getConnect;
    $result = mysqli_query($getConnect, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
//================== END SELECT DATA ==================




//================= FUNCTION FOR CRUD DATA =================
function fetchCustomer(){
    global $getConnect;
    $query = "SELECT id_cust, nama_cust, no_telp FROM customers";
    $result = mysqli_query($getConnect, $query);
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function fetchProduct(){
    global $getConnect;
    $query = "SELECT id_product, nama_product, harga FROM products";
    $result = mysqli_query($getConnect, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
function getHargaProduct($id_product){
    global $getConnect;
    $query = "SELECT harga FROM products WHERE id_product = '$id_product'";
    $result = mysqli_query($getConnect, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function addDataProduct($product_image, $nama_product, $harga){
    global $getConnect;
    $query = "INSERT INTO products VALUES('', '$product_image','$nama_product', '$harga')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function uploadImage()
{
    $namaFile = $_FILES['product_image']['name'];
    $ukuranFile = $_FILES['product_image']['size'];
    $error = $_FILES['product_image']['error'];
    $tmpName = $_FILES['product_image']['tmp_name'];

    // Cek apakah gambar diupload atau tidak
    if ($error === 4) {
        $msg = "Failed to add data. Please upload an image first.";
        header("Location: ../admin/data_product.php?container=product&message&delete_message=" . urlencode($msg));
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);

    // Cek ekstensi gambar yang diupload
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $msg = "Failed to add data. The file you uploaded is not an image.";
        header("Location: ../admin/data_product.php?container=product&message&delete_message=" . urlencode($msg));
        exit;
    }

    // Cek ukuran file gambar
    $maxFileSize = 50 * 1024 * 1024; // 50MB dalam byte
    if ($ukuranFile > $maxFileSize) {
        $msg = "Failed to add data. The uploaded image is too large (max: 50MB).";
        header("Location: ../admin/data_product.php?container=product&message&delete_message=" . urlencode($msg));
        exit;
    }

    // Generate nama file baru
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    move_uploaded_file($tmpName, '../image/product/' . $namaFileBaru);
    return $namaFileBaru;
}



function updateImage($id_product, $imageLama, $nama_product, $harga){
    global $getConnect;
        //cek apakah user memilih file baru atau tdk
        if($_FILES['image']['error'] === 4) {
            $image = $imageLama;
        } else {
        $product_image = uploadImage();
        }
    
        $query = "UPDATE products SET product_image = '$product_image', nama_product = '$nama_product', harga = '$harga' WHERE id_product = '$id_product'";
        $result = mysqli_query($getConnect, $query);
    
        //return angka ketika ada data yang berhasil di upadate di database
        return mysqli_affected_rows($getConnect);
}

function getProductId($id_product){
    global $getConnect;
    $result = mysqli_query($getConnect, "SELECT * FROM products WHERE id_product = '$id_product'");
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function updateDataProduct($id_product, $product_image, $nama_product, $harga) {
    global $getConnect;
    $query = "UPDATE products SET product_image = '$product_image', nama_product = '$nama_product', harga = '$harga' WHERE id_product = '$id_product'";
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

function addDataCustomer($nama_cust, $alamat, $no_telp, $email){
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
            customers.id_cust, 
            products.id_product, 
            transactions.tanggal, 
            transactions.jumlah_product, 
            products.harga, 
            transactions.total_pembayaran
            FROM customers 
            INNER JOIN transactions ON customers.id_cust = transactions.id_cust 
            INNER JOIN products ON products.id_product = transactions.id_product WHERE transactions.id_transaction = '$id_transaction'";
    $result = mysqli_query($getConnect, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function addDataTransaction($id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran){
    global $getConnect;
    $query = "INSERT INTO transactions VALUES('', '$id_cust', '$id_product', '$tanggal', '$jumlah', '$harga', '$total_pembayaran')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}


function updateDataTransaction($id_transaction, $id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran){
    global $getConnect;
    $query = "UPDATE transactions SET id_cust = '$id_cust', id_product = '$id_product', tanggal = '$tanggal', jumlah_product = '$jumlah', harga = '$harga', total_pembayaran = '$total_pembayaran' WHERE id_transaction = '$id_transaction'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function deleteDataTransaction($id_transaction){
    global $getConnect;
    $query = "DELETE FROM transactions WHERE id_transaction = '$id_transaction'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}
//================== END CRUD DATA ==================


//================= FUNCTION FOR AUTHENTICATION =================
function addUsersData($email, $password, $fullname, $role, $access_code){
    global $getConnect;
    $query = "INSERT INTO users VALUES('', '$email', '$password', '$fullname', '$role', '$access_code')";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function getUsersByEmail($email){
    global $getConnect;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($getConnect, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function getUsersData($email){
    global $getConnect;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function deleteDataUsers($id_user){
    global $getConnect;
    $query = "DELETE FROM users WHERE id_user = '$id_user'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}

function validatePassword($password) {
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
        return true;
    }
    return false;
}

//================== END AUTHENTICATION ==================

function adminVerify($adminEmail){
    global $getConnect;
    $query = "SELECT access_code FROM users WHERE email = '$adminEmail'";
    $result = mysqli_query($getConnect, $query);
    return $result;
}
