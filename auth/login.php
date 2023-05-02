<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/login.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Login to Rofara Store Account</title>
</head>
<body>
    <div class="container">
        <section class="wrapper">
            <div id="box" class="box1">
                <div class="title">
                    <h2 class="page-title">Unleash Your Creativity with ROFARA STORE</h2>
                    <h3 class="welcome-message">Login to your account and start designing today</h3>
                </div>
            </div>
            <div id="box" class="box2">

            <div>
                <h3 class="log_your">Login to your account</h3>
                <span class="login-text">Login</span>
                <?php
                if (isset($_GET['message'])) {
                    $msg = $_GET['message'];
                    echo "<div class= 'notif-login'>$msg</div>";
                }?>
            <form action="../includes/action.php?auth=login" method="post">
                <div class="input-kolom">
                            <ul style="list-style-type: none;">
                            <div class="input-con">
                                <li>
                                    <label for="email">Email</label>
                                    <input type="email"name="email" id="email" placeholder="Email" class="input-bar" autocomplete="off" required>
                                </li>
                                <li>
                                    <label for="password">Password</label>
                                    <input type="password"name="password" id="password" placeholder="******" class="input-bar" autocomplete="off" required>
                                </li>
                            </div>
                                <li class="checkbox_container">
                                    <input type="checkbox" name="remember" id="remember" class="checkbox">
                                    <label for="remember" class="remember">Remember my account</label>
                                </li>
                                <li>
                                    <button type="submit" name="auth_submit" class="btn">Login</button>
                                </li>
                            </ul>
                            <div class="cta">
                                <p class="cta-text">Don't have an account?
                                <span class="cta-text2"><a href="register.php">Register</a></span></p>
                            </div>
                        </div>
                    </form>         
                </div>
            </div>
        </section>
    </div>

</body>
</html>