<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
     <?php 
    if(isset($_GET['message'])) {
        $msg = $_GET['message'];
        echo $msg;
    }
    ?>
    <h1>Login Form</h1>
    <h3>Hello, welcome back</h3>
    <form action="../includes/action.php?auth=login" method="post">
        <ul style="list-style-type: none;">
            <li>
                <label for="email">Email</label>
                <input type="email"name="email" id="email" placeholder="Email" autocomplete="off" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password"name="password" id="password" placeholder="Password" autocomplete="off" required>
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="auth_submit">Login</button>
            </li>
        </ul>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>