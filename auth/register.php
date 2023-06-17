<?php
session_start();

// if (isset($_SESSION['status'])) {
//     header('Location: ../index.php');
//     exit;
// } else if($_SESSION['role'] === 'admin'){
//     header("location:register.php");
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Create your account</title>
</head>

<body>
    <main>
        <div id="wrapper" class="register_wrapper">
            <section id="content" class="form_content">
                <div class="form_container_register">
                    <h3 class="auth_title">Create your account</h3>
                    <span class="text_span">Register</span>
                    <?php
                    if (isset($_GET['message'])) {
                        $msg = $_GET['message'];
                        echo "<div class= 'notif'>$msg</div>";
                    } ?>
                    <form action="../includes/action.php?auth=register" method="POST">
                        <ul style="list-style-type: none;">
                            <div class="input_container_register">
                                <div class="form_row">
                                    <li class="form_group">
                                        <label for="fname" class="label-wrap">First Name</label>
                                        <input type="text" name="fname" id="fname" placeholder="First Name" class="input_bar" required>
                                    </li>
                                    <li class="form_group">
                                        <label for="lname" class="label-wrap">Last Name</label>
                                        <input type="text" name="lname" id="lname" placeholder="Last Name" class="input_bar" required>
                                    </li>
                                </div>
                                <li>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="input_bar" required>
                                </li>
                                <div class="form_row">
                                    <li class="form_group">
                                        <label for="password" class="label-wrap">Password</label>
                                        <input type="password" name="password" id="password" placeholder="******" class="input_bar" autocomplete="off" required>
                                    </li>
                                    <li class="form_group">
                                        <label for="cpassword" class="label-wrap">Confirm</label>
                                        <input type="password" name="cpassword" id="cpassword" placeholder="******" class="input_bar" autocomplete="off" required>
                                    </li>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['status']) && $_SESSION['role'] === 'admin') : ?>
                                <li>
                                    <input type="hidden" name="role" value="user">
                                </li>
                                <li>
                                    <label for="access_code" class="label-wrap">Dashboard Pass</label>
                                    <input type="password" name="access_code" id="access_code" placeholder="******" class="input_bar" autocomplete="off" required>
                                </li>
                            <?php else : ?>
                                <li>
                                    <input type="hidden" name="role" value="user">
                                </li>
                                <li>
                                    <input type="hidden" name="access_code" value="null">
                                </li>
                            <?php endif; ?>

                            <li>
                                <button type="submit" name="auth_submit" class="btn_register">Register</button>
                            </li>
                        </ul>
                        <div class="cta">
                            <p class="cta_text">Already have an account?
                                <span class="cta_text2"><a href="login.php">Login</a></span>
                            </p>
                        </div>
                    </form>
            </section>

            <section id="content" class="page_content">
                <div class="page_header_register">
                    <h2 class="page_title">Get Started on Your Creative Journey</h2>
                    <p class="page_subtitle_register">Ready to Unleash Your Creativity? Register now</p>
                    <a class="guest_text" href="../index.php">Explore as a guest</a>
                </div>
            </section>

        </div>
        </div>
    </main>

</body>

</html>