<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Edit Produk</h1
    <form action="../includes/action.php" method="POST">
        <ul>
            <input type="hidden" name="id_jasa">
            <li>
                <label for="product">Produk</label>
                <input type="text" name="product" id="product">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga">
            </li>
            <li>
                <button type="submit" name="jasa_submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>