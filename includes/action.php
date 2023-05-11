<?php 
require 'functions.php';
session_start();


//================= ACTION FOR CRUD DATA =================
// CRUD DATA PRODUCT
if(isset($_POST['product_submit'])) {
    $nama_product = htmlspecialchars($_POST['product']);
    $harga = htmlspecialchars($_POST['harga']);

    if($_GET['action'] === 'addProduct') {
        $result = addDataProduct($nama_product, $harga);
        if ($result) {
            $msg = "Product data has been successfully added";
            header("Location: ../admin2/data_product.php?message=" . urlencode($msg));
            exit();
        } else {
            header("Location: ../admin2/data_product.php");
        }

    } else if($_GET['action'] === 'updateProduct'){
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


//ACTION DATA CUSTOMERS
if(isset($_POST['cust_submit'])){
    $nama_cust = htmlspecialchars($_POST['cust']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = strtolower(htmlspecialchars($_POST['email']));

    if($_GET['action'] === 'addCustomer'){
        $result = addDataCustomer($nama_cust, $alamat, $no_telp, $email);
        if($result){
            $msg = "Customer data has been successfully added";
            header("Location: ../admin2/data_cust.php?" . urlencode($msg));
            exit;
        } else {
            header("Location: ../admin2/data_product.php");
        }

    } else if($_GET['action'] === 'updateCustomer'){
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


//ACTION DATA TRANSACTIONS
if(isset($_POST['transaction_submit'])){
    $id_product = $_POST['id_product'];
    $id_cust = $_POST['id_cust'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    
    $row = getHargaProduct($id_product);
    $harga = $row['harga'];
    $total_pembayaran = $harga * $jumlah;
    if($_GET['action'] === 'addTransaction'){
        if($_POST === 0) {
            $msg = "Please select product";
        } else {
        $result = addDataTransaction($id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran);
        if($result){
            $msg = "Transaction data has been successfully added";
            header("Location: ../admin2/data_transaction.php?message=" . urlencode($msg));
            exit();
        }
        }
    } else if($_GET['action'] === 'updateTransaction'){
        $id_transaction = $_POST['id_transaction'];
        $result = updateDataTransaction($id_transaction, $id_cust, $id_product, $tanggal, $jumlah, $harga, $total_pembayaran);
        if($result){
            $msg = "Transaction data has been successfully updated";
            header("Location: ../admin2/data_transaction.php?message=" . urlencode($msg));
            exit();
        }
    }
}
//END TRANSACTIONS


//ACTION DELETING DATAS
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

    } else if($_GET['page'] === 'transaction'){
        $id_transaction = $_GET['id_delete'];
        $result = deleteDataTransaction($id_transaction);
        if($result){
            $msg = "Transaction data has been successfully deleted";
            header("Location: ../admin2/data_transaction.php?message=" . urlencode($msg));
            exit();
        }

    } else if($_GET['page'] === 'user'){
        $id_user = $_GET['id_delete'];
        $result = deleteDataUsers($id_user);
        if($result){
            $msg = "User data has been successfully deleted";
            header("Location: ../admin/data_user.php?message=" . urlencode($msg));
            exit();
        }
    }
}
//END DELETING DATAS
//================== END CRUD DATAS ==================


//================= VALIDASI / CONDITION FOR AUTHENTICATION =================
if(isset($_POST['auth_submit']) && $_GET['auth'] === 'register'){
    //data yang diketikkan user bakal ditampung ke variable
    $email = htmlspecialchars(strtolower($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $fullname = htmlspecialchars(ucwords($_POST['fname'])) . ' ' . htmlspecialchars(ucwords($_POST['lname']));
    $confirm_password = htmlspecialchars($_POST['cpassword']);
    $role = $_POST['role'];

    //Validasi dikit & membuat enkripsi password
    if(getUsersData($email) == 0){
        if(strlen($password) && strlen($confirm_password)>= 3){
            if($password === $confirm_password){
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $result = addUsersData($email, $pass, $fullname, $role);
                if($result){
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
            $msg = "Password must contain at least 3 characters";
            header("Location: ../auth/register.php?message=" . urlencode($msg));
            exit();
        }
    } else {
        $msg = "Email already registered";
        header("Location: ../auth/register.php?message=" . urlencode($msg));
        exit();
    }

} else if (isset($_POST['auth_submit']) && $_GET['auth'] === 'login'){
    //data yang diketikkan user bakal ditampung divariable ini
    $email = htmlspecialchars(strtolower($_POST['email']));
    $password = htmlspecialchars($_POST['password']);

    //validasi apakah data ada atau tidak didatabase
    $result = getUsersData($email);
    if($info->num_rows > 0){
        $row = mysqli_fetch_assoc($info);
        if(password_verify($password, $row['password'])){

            //nampung data dibrowser
            $_SESSION['status'] = true;
            $_SESSION['email'] = $row['email']; 
            $_SESSION['fullname'] = $row['fullname']; 
            $_SESSION['role'] = $row['role']; 

            if(isset($_POST['remember'])){
                setcookie('id', 'apakek',time()+3600);
            }

            $msg = "Yayy! you have successfully logged in!";
            header("Location: ../home.php?message=" . urlencode($msg));
        } else{
            $msg = "Incorrect email or password";
            header("Location: ../auth/login.php?message=" . urlencode($msg));
        } 
    } else {
        $msg = "Incorrect email or password";
        header("Location: ../auth/login.php?message=" . urlencode($msg));
    }
}

//================== END AUTHENTICATION ==================
