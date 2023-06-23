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

if(isset($_POST['request_operator_submit'])){
    // $id_product = $_GET['id_product'];
    // $getProductById = getProductId($id_product);

    $nama_product = $_POST['product'];
    $harga = $_POST['harga'];
    $product_image = uploadImage();
    if (!$product_image) {
        return false; //return false dia bakal memberhentikan eksekusi sampai sini, dan tidak ada menjalankan syntac selanjutnya
    }

    //SETTING DATE 
    date_default_timezone_set('Asia/Jakarta');
    $jamSekarang = date('d M Y H:i' );

    if($_GET['action'] === 'request_updateProduct'){

        $operator = $_SESSION['email'];

        $_SESSION['request'][] = [
            'nama_sender' => $operator,
            'send_time' => $jamSekarang,
            'nama_product' => $nama_product, 
            'harga' => $harga, 
            'product_image' => $product_image
        ];

        // var_dump($_SESSION['request']);
        header("location: ../admin/data_product.php");
    }
}       

if(isset($_GET['accept_request'])){
    $accept_req = $_GET['accept_request'];

    $result = $_SESSION['request'][$accept_req];
    // var_dump($result);

    $msg = 'Successful add a request to database';
    header("Location: ../admin/data_product.php?message&add_message=" . urlencode($msg));
}






if(isset($_GET['reject_request'])){
    $reject_req = $_GET['reject_request'];

    // unset($_SESSION['request'][$reject_req]);

    $msg = 'rejected some request';
    header("Location: ../admin/data_product.php?message&delete_message=" . urlencode($msg));
}























//==================  REQUEST OPERATOR ==================
// if(isset($_POST['request_operator_submit'])){
//     $nama_product = htmlspecialchars($_POST['product']);
//     $harga = htmlspecialchars($_POST['harga']);
//     $product_image = uploadImage();

//     if (!$product_image) {
//         return false; //return false dia bakal memberhentikan eksekusi sampai sini, dan tidak ada menjalankan syntac selanjutnya
//     }
//     $result = [$nama_product, $harga, $product_image];
    
//     if ($_GET['action'] === 'request_updateProduct') {
//         $id_product = $_POST['id_product'];
//         $row = getProductId($id_product);
        
//         $operator_request = $_SESSION['email'];

//         // MEMBUAT VARIABLE SUPER GLOBAL CART
//         $_SESSION['request'][] = 
//         [
//             'nama_product' => $nama_product,
//             'harga' => $harga,
//             'nama_product' => $nama_product
//         ];

//         header('Location: ../admin/data_product.php');
//     }
// }


//================== END REQUEST ==================

