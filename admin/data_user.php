<?php 
require '../includes/functions.php';

$query = "SELECT * FROM users";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Admin | Data Users</title>
</head>
<body>
<?php
    if (isset($_GET['message'])) {
        $msg = $_GET['message'];
        echo "<div class= 'notif'>$msg</div>";
    } ?>
    <a href="../auth/logout.php">Logout</a>
    <h1>Data Users</h1>
    <nav>
        <ul>
            <li><a href="data_product.php">Data Product</a></li>
            <li><a href="data_cust.php">Data Customer</a></li>
            <li><a href="data_transaction.php">Data Transaksi</a></li>
            <li><a href="data_user.php">Data Personal User</a></li>
        </ul>
    </nav>
    <table border="1" cellspacing="0.5" cellpadding="10">
        <tr>
            <th>Id user</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $row['id_user'];?></td>
            <td><?= $row['email'];?></td>
            <td><?= $row['fullname'];?></td>
            <td><?= $row['role'];?></td>
            <td>
                <a href="">Edit</a> |
                <a href="../includes/action.php?id_delete=<?= $row['id_user'];?>&page=user">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>