<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/login.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Create your account</title>
</head>
<body>
    <div class="container">
        <section class="wrapper_reg">
            <div id="box" class="box2">
            <!-- <span class="login-text">login</span> -->

                <?php
                if (isset($_GET['message'])) {
                    $msg = $_GET['message'];
                    echo "<div class= 'notif-login'>$msg</div>";
                }?>
                <div>
                    <form action="../includes/action.php?auth=login" method="post" target="blank">
                        <div class="input-kolom">
                            <ul style="list-style-type: none;">
                                <li>
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" id="fname" placeholder="First Name" class="input-login" required>
                                </li>
                                <li>
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" id="lname" placeholder="Last Name" class="input-login" required>
                                </li>
                                <li>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="input-login" required>
                                </li>
                                <li>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="******" class="input-login" autocomplete="off" required>
                                </li>
                                <li>
                                    <label for="cpassword">Confirm Password</label>
                                    <input type="password" name="cpassword" id="cpassword" placeholder="******" class="input-login" autocomplete="off" required>
                                </li>
                                <li>
                                    <input type="hidden" name="role" value="user">
                                </li>
                                <li>
                                    <button type="submit" name="auth_submit" class="btn">Login</button>
                                </li>
                            </ul>
                            <div class="register-container">
                                <p class="acc-text">Already have an account?
                                <span class="register-text"><a href="login.php">Login</a></span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="box" class="box1">
                <div class="title">
                    <h2 class="page-title">Unleash Your Creativity with ROFARA STORE</h2>
                    <h3 class="welcome-message">Login to your account and start designing today</h3>
                </div>
            </div>
        </section>
    </div>

</body>
</html>