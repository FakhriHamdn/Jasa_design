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
            <div class="title">
                <h2 class="page-title">Unleash Your Creativity with ROFARA Store</h2>
                <h3 class="welcome-message">Login to your account and start designing today</h3>
                <span class="login-text">login</span>
                <!-- buat munculin notif -->
                <?php
                if (isset($_GET['message'])) {
                    $msg = $_GET['message'];
                    echo "<div class= 'notif-login'>$msg</div>";
                }
                ?>
            </div>
            <div>
                <form action="../includes/action.php?auth=login" method="post">
                    <div class="input-kolom">
                        <ul style="list-style-type: none;">
                            <li>
                                <div class="input-email">
                                <label for="email">Email</label>
                                <input type="email"name="email" id="email" placeholder="Email" class="input-login" autocomplete="off" required>
                                </div>
                            </li>
                            <li class="input-pass">
                                <label for="password">Password</label>
                                <input type="password"name="password" id="password" placeholder="******" class="input-login" autocomplete="off" required>
                            </li>
                            <li>
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Remember Me</label>
                            </li>
                            <li>
                                <button type="submit" name="auth_submit" class="btn">Login</button>
                            </li>
                        </ul>
                        <div class="register-container">
                        <p class="acc-text">Don't have an account?
                        <span class="register-text"><a href="register.php">Register</a></span>
                        </p>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

</body>
</html>