<?php 
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/home1.css">
    <title>Document</title>
</head>

<body>
    <main>
        <nav>
            <ul>
                <li><a href="#">Profil</a></li>
                <?php if (isset($_SESSION['status'])) : ?>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <li><a href="#">Tabel Database</a></li>
                    <?php endif; ?>
                    <?php else : ?>
                        <li><a href="auth/login.php">Login</a></li>
                        <li><a href="auth/register.php">Register</a></li>
                        
                        <?php endif; ?>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="auth/logout.php">Logout</a></li>

            </ul>
        </nav>
    </main>
</body>

</html>