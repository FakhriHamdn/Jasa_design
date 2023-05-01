<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
</head>
<body>
    
    <?php 
    if(isset($_GET['message'])) {
        $msg = $_GET['message'];
        echo $msg;
    }
    
    ?>

    <h1>Hello! Let's join with us</h1>
    <form action="../includes/action.php?auth=register" method="POST">
        <ul style="list-style-type: none;">
            <li>
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" placeholder="First Name">
            </li>
            <li>
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" placeholder="Last Name">
            </li>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </li>
            <li>
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
            </li>
            <li>
            <input type="hidden" name="role" value="user">
            </li>
            <li>
                <button type="submit" name="auth_submit">Register</button>
            </li>
        </ul>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
    
</body>
</html>