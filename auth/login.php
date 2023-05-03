<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/login.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Login to your account</title>
</head>

<body>
    <main>
        <div id="wrapper" class="login_wrapper">

            <section id="content" class="page_content">
                <div class="page_header">
                    <h2 class="page_title">Unleash Your Creativity with ROFARA STORE</h2>
                    <h3 class="page_subtitle">Login to your account and start designing today</h3>
                </div>
            </section>

            <section id="content" class="form_content">
                <div class="form_container">
                    <h3 class="auth_title">Login to your account</h3>
                    <span class="text_span">Login</span>
                    <?php
                    if (isset($_GET['message'])) {
                        $msg = $_GET['message'];
                        echo "<div class= 'notif'>$msg</div>";
                    } ?>
                    <form action="../includes/action.php?auth=login" method="POST">
                        <ul>
                            <div class="input_container">
                                <li>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="input_bar" autocomplete="off" required>
                                </li>
                                <li>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="******" class="input_bar" autocomplete="off" required>
                                </li>
                            </div>
                            <li class="checkbox_container">
                                <input type="checkbox" name="remember" class="checkbox">
                                <label class="remember">Remember my account</label>
                            </li>
                            <li>
                                <button type="submit" name="auth_submit" class="btn">Login</button>
                            </li>
                        </ul>
                        <div class="cta">
                            <p class="cta_text">Don't have an account?
                                <span class="cta_text2"><a href="register.php" id="register-form">Register</a></span>
                            </p>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </main>
</body>
</html>