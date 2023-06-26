<?php
require 'functions.php';
session_start();


//================= ACTION FOR CRUD DATA =================
// CRUD DATA PRODUCT
if (isset($_POST['product_submit'])) {
    $nama_product = htmlspecialchars($_POST['product']);
    $harga = htmlspecialchars($_POST['harga']);
    $product_image = uploadImage();
    if (!$product_image) {
        return false; //return false dia bakal memberhentikan eksekusi sampai sini, dan tidak ada menjalankan syntac selanjutnya
    }

    if ($_GET['action'] === 'addProduct') {
        if (empty($nama_product) || empty($harga)) {
            $msg = "Cannot add null product";
            header("Location: ../admin/data_product.php?message=" . urlencode($msg));
            exit();
        } else {
            $result = addDataProduct($product_image, $nama_product, $harga);
            if ($result) {
                $msg = "Product data has been successfully added";
                header("Location: ../admin/data_product.php?message&add_message=" . urlencode($msg));
                exit();
            } else {
                header("Location: ../admin/data_product.php");
            }
        }
    } else if ($_GET['action'] === 'updateProduct') {
        $id_product = $_POST['id_product'];
        $row = getProductId($id_product);
        if ($row) {
            $result = updateDataProduct($id_product, $product_image, $nama_product, $harga);
            if ($result) {
                $msg = "Product data has been successfully updated";
                header("Location: ../admin/data_product.php?message&update_message=" . urlencode($msg));
                exit();
            }
        }
    }
}
//END PRODUCTS


//ACTION DATA CUSTOMERS
if (isset($_POST['cust_submit'])) {
    $nama_cust = htmlspecialchars($_POST['cust']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = strtolower(htmlspecialchars($_POST['email']));

    if ($_GET['action'] === 'addCustomer') {
        $result = addDataCustomer($nama_cust, $alamat, $no_telp, $email);
        if ($result) {
            $msg = "Customer data has been successfully added";
            header("Location: ../admin/data_cust.php?" . urlencode($msg));
            exit;
        } else {
            header("Location: ../admin/data_product.php");
        }
    } else if ($_GET['action'] === 'updateCustomer') {
        $id_cust = $_POST['id_cust'];
        $row = getCustomerId($id_cust);
        if ($row) {
            $result = updateDataCustomer($id_cust, $nama_cust, $alamat, $no_telp, $email);
            if ($result) {
                $msg = "Customer data has been successfully updated";
                header("Location: ../admin/data_cust.php?message=" . urlencode($msg));
                exit();
            }
        }
    }
}
//END CUSTOMERS


//ACTION DATA TRANSACTIONS
if (isset($_POST['transaction_submit'])) {
    $id_product = $_POST['id_product'];
    $id_cust = $_POST['id_cust'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $row = getHargaProduct($id_product);
    $harga = $row['harga'];
    $total_pembayaran = $harga * $jumlah;
    if ($_GET['action'] === 'addTransaction') {
        if ($_POST === 0) {
            $msg = "Please select product";
        } else {
            $result = addDataTransaction($id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran);
            if ($result) {
                $msg = "Transaction data has been successfully added";
                header("Location: ../admin/data_transaction.php?message=" . urlencode($msg));
                exit();
            }
        }
    } else if ($_GET['action'] === 'updateTransaction') {
        $id_transaction = $_POST['id_transaction'];
        $result = updateDataTransaction($id_transaction, $id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran);
        if ($result) {
            $msg = "Transaction data has been successfully updated";
            header("Location: ../admin/data_transaction.php?message=" . urlencode($msg));
            exit();
        }
    }
}
//END TRANSACTIONS


//ACTION DELETING DATAS
if (isset($_GET['id_delete'])) {
    if ($_GET['page'] === 'product') {
        $id_product = $_GET['id_delete'];
        $result = deleteDataProduct($id_product);
        if ($result) {
            $msg = "Product data has been successfully deleted";
            header("Location: ../admin/data_product.php?message&delete_message=" . urlencode($msg));
            exit();
        }
    } else if ($_GET['page'] === 'customer') {
        $id_cust = $_GET['id_delete'];
        $result = deleteDataCustomer($id_cust);
        if ($result) {
            $msg = "Customer data has been successfully deleted";
            header("Location: ../admin/data_cust.php?message=" . urlencode($msg));
            exit();
        }
    } else if ($_GET['page'] === 'transaction') {
        $id_transaction = $_GET['id_delete'];
        $result = deleteDataTransaction($id_transaction);
        if ($result) {
            $msg = "Transaction data has been successfully deleted";
            header("Location: ../admin/data_transaction.php?message=" . urlencode($msg));
            exit();
        }
    } else if ($_GET['page'] === 'user') {
        $id_user = $_GET['id_delete'];
        $result = deleteDataUsers($id_user);
        if ($result) {
            $msg = "User data has been successfully deleted";
            header("Location: ../admin/data_user.php?message=" . urlencode($msg));
            exit();
        }
    }
}
//END DELETING DATAS
//================== END CRUD DATAS ==================



//================= VALIDASI / CONDITION FOR AUTHENTICATION =================
if (isset($_POST['auth_submit']) && $_GET['auth'] === 'register') {
    //data yang diketikkan user bakal ditampung ke variable
    $email = htmlspecialchars(strtolower($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $fullname = htmlspecialchars(ucwords($_POST['fname'])) . ' ' . htmlspecialchars(ucwords($_POST['lname']));
    $confirm_password = htmlspecialchars($_POST['cpassword']);
    $role = $_POST['role'];
    $access_code = $_POST['access_code'];

    //Validasi dikit & membuat enkripsi password
    if (getUsersByEmail($email) == 0) {
        if (strlen($password) && strlen($confirm_password) >= 3) {
            if (validatePassword($password) >= 2) {
                if ($password === $confirm_password) {
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    $result = addUsersData($email, $pass, $fullname, $role, $access_code);
                    if ($result) {
                        $msg = "Yayy! You have successfully registered on our page";
                        header("Location: ../auth/login.php?message=" . urlencode($msg));
                        exit();
                    }
                } else {
                    $msg = "Passwords are not equal";
                    header("Location: ../auth/register.php?message=" . urlencode($msg));
                    exit();
                }
            } else {
                $msg = "Password is not strong enough";
                header("Location: ../auth/register.php?message=" . urlencode($msg));
                exit();
            }
        } else {
            $msg = "Password must contain at least 3 characters";
            header("Location: ../auth/register.php?message=" . urlencode($msg));
            exit();
        }
    } else {
        $msg = "Email already registered";
        header("Location: ../auth/register.php?message=" . urlencode($msg));
        exit();
    }

} else if (isset($_POST['auth_submit']) && $_GET['auth'] === 'login') {
    //data yang diketikkan user bakal ditampung divariable ini
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    //validasi apakah data ada atau tidak didatabase
    $result = getUsersData($email);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            //nampung data dibrowser
            $_SESSION['status'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['role'] = $row['role'];


            if (isset($_POST['remember'])) {
                setcookie('id', $row['id_user'], time() + 3600, "/"); //cookie pake "/" biar bisa diakses semua file diberbagai folder
            }

            $msg = "Yayy! you have successfully logged in!";
            if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'operator') {
                header("Location: ../admin/data_product.php?message=" . urlencode($msg));
                exit();

            } else {
                header("Location: ../index.php?message=" . urlencode($msg));
                exit();
            }
        } else {
            $msg = "Incorrect email or password";
            header("Location: ../auth/login.php?message=" . urlencode($msg));
            exit();
        }
    } else {
        $msg = "Incorrect email or password";
        header("Location: ../auth/login.php?message=" . urlencode($msg));
        exit();
    }
}
//================== END AUTHENTICATION ==================



//================== CART SYSTEM ==================
if (isset($_GET['add_to_cart'])) {
    $id_product = $_GET['add_to_cart'];
    $row = getProductId($id_product); //ngambil semua data product berdasarkan id tertentu

    $userIdentity = $_SESSION['email'];

    // MEMBUAT VARIABLE SUPER GLOBAL CART
    $_SESSION['cart'][$userIdentity][] = $row['nama_product'];

    // var_dump($_SESSION['cart'][$userIdentity]);
    header('Location: ../public/marketplace/marketplace.php');
}

if (isset($_GET['remove_from_cart'])) {
    $key = $_GET['remove_from_cart'];
    $userIdentity = $_SESSION['email'];
    // Hapus produk dari keranjang jika ada
    unset($_SESSION['cart'][$userIdentity][$key]);
    header("Location: ../keranjang.php");
}
//================== END CART SYSTEM ==================



//================== DASHBOARD VERIFY ==================
if (isset($_POST['dashboard_verify'])) {
    $pass_verify = htmlspecialchars($_POST['pass_verify']);

    $adminEmail = $_SESSION['email'];
    $result = getUsersData($adminEmail);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($pass_verify === $row['access_code']) {

            $_SESSION['verify'] = true;

            $msg = "Welcome " . $_SESSION['fullname'];
            header("Location: ../admin/data_product.php?message&auth_message=" . urlencode($msg));
            exit();

        } else {
            $msg = "Incorrect password";
            header("Location: ../auth/verify.php?message=" . urlencode($msg));
            exit();
        }
    } else {
        $msg = "Incorrect password";
        header("Location: ../auth/verify.php?message=" . urlencode($msg));
        exit();
    }
}
//================== END VERIFY ==================



//================== ACTION REQUEST OPERATOR ==================
//======= ACTION CREATE AN REQUEST 
if(isset($_POST['request_operator_submit'])){
    $id_product = $_POST['id_product'];
    $nama_product = htmlspecialchars($_POST['product']);
    $harga = htmlspecialchars($_POST['harga']);
    $notes = htmlspecialchars($_POST['notes']);
    $product_image = uploadImage();
    if (!$product_image) {
        return false; //return false dia bakal memberhentikan eksekusi sampai sini, dan tidak ada menjalankan syntac selanjutnya
    }

    //SETTING DATE 
    date_default_timezone_set('Asia/Jakarta');
    $jamSekarang = date('d M Y H:i' );

    $operator = $_SESSION['email'];
    if($_GET['action'] === 'requestUpdateProduct'){
        $_SESSION['request'][] = [
            'nama_sender' => $operator,
            'send_time' => $jamSekarang,
            'id' => $id_product, 
            'nama_product' => $nama_product, 
            'harga' => $harga, 
            'product_image' => $product_image,
            'notes' => $notes,
            'status' => 'Update'
        ];

    } else if($_GET['action'] === 'requestAddProduct'){
        $_SESSION['request'][] = [
            'nama_sender' => $operator,
            'send_time' => $jamSekarang,
            'nama_product' => $nama_product, 
            'harga' => $harga, 
            'product_image' => $product_image,
            'notes' => $notes,
            'status' => 'New'
        ];
    }
    header("location: ../admin/data_product.php");
    exit;
}       
//======= END CREATE REQUEST 


//======= ACTION TO ACCEPT AN REQUEST 
if(isset($_GET['key_accept_request'])){
    $key_request = $_GET['key_accept_request'];
    $row = $_SESSION['request'][$key_request]; //AMBIL DATA YANG DIMASUKKAN OLEH OPERATOR

    if(isset($_POST['accept_new_request'])){
        $nama_product = $_POST['product'];
        $harga = $_POST['harga'];
        $product_image = uploadImage();
        if (!$product_image) {
            return false;
        }

    } else if(isset($_POST['accept_update_request'])){
        if($row['product_image'] != uploadImage()){
            $product_image = $row['product_image'];
        } else {
            $product_image = uploadImage();
        }
        
        if($row['nama_product'] != $_POST['product']){
            $nama_product = $row['nama_product'];
        } else {
            $nama_product = $_POST['product'];
        }
        
        if($row['harga'] != $_POST['harga']){
            $harga =  $row['harga'];
        } else {
            $harga =  $_POST['harga'];
        }

        var_dump($product_image, $nama_product, $harga);
        exit;

    }

    
    // $key_request = $_GET['accept_request'];
    
    if(isset($_GET['accept_from_table'])){
        // NYIMPEN DATA PENTING YANG DIPERLUKAN DI DATABASE
        $product_image = $row['product_image'];
        $nama_product = $row['nama_product'];
        $harga = $row['harga'];

        header("location: berhasil.php");

        // echo 'hello';exit;
    }

    $id_product = $row['id'];

    // VALIDASI SEBELUM KEDATABASE BERDASARKAN STATUS TERTENTU
    if($row['status'] === 'New'){
        $result = addDataProduct($product_image, $nama_product, $harga);
        $msg = 'Successful add new data request';
        
    } else if ($row['status'] === 'Update'){
        $result = updateDataProduct($id_product, $product_image, $nama_product, $harga);
        $msg = 'Successful add an update data request';
    }

    //JIKA SUDAH SELESAI TEREKSEKUSI MAKA SESSION TERKAIT AKAN DIHAPUS
    unset($_SESSION['request'][$key_request]);
    header("Location: ../admin/data_product.php?message&add_message=" . urlencode($msg));
}
//======= END ACCEPT AN REQUEST 


//======= ACTION TO REJECT AN REQUEST 
if(isset($_GET['reject_request'])){
    $key_reject = $_GET['key_request'];

    unset($_SESSION['request'][$key_reject]);

    $msg = 'rejected some request';
    header("Location: ../admin/data_product.php?message&delete_message=" . urlencode($msg));
}
//======= END REJECT REQUEST 
//================== END REQUEST ==================
