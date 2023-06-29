<?php 
session_start();

//====== VALIDASI AKSES
if(!isset($_SESSION['status'])){
    header("Location: ../index.php");
    exit;

} else if(isset($_SESSION['role'])) {
    if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'operator'){
        if (isset($_SESSION['verify'])){
            header("Location: ../admin/data_product.php");
            exit;
        }

        header("location:");
    } else {
        header("location: ../index.php");
        exit;
    }
} 
//======= END VALIDASI


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--===== LINK-LINK =====-->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css" />
    <!--===== END =====-->

    <title>Access Control | Verify</title>
</head>

<body>
    <div class="verify_container">
        <div class="verify_wrapper">
            <div class="verify_box">
                <div class="title_verify">
                    <h3>Access Control</h3>
                    <h5>Access Verification for Dashboard</h5>
    
                    <span class="text_verify">Verify</span>
                <?php
                if (isset($_GET['message'])) {
                    $msg = $_GET['message'];
                    echo "<div class= 'notif'>$msg</div>";
                } ?>
                </div>


                <form action="../includes/action.php" class="verify_form " method="post">
                    <input type="password" name="pass_verify" placeholder="******" class="input_bar" autocomplete="off" required autofocus>

                    <div class="verify_button_wrapper">
                        <button type="submit" name="dashboard_verify" class="btn">Verify</button>
                        <a href="../index.php"><i class="bx bx-log-out icon"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>