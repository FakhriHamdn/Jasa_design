<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Array Assosiatif</title>
</head>
<body>
    <h1>Upload Image</h1>
    <form action="action.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="upload_image">Image</label>
                <input type="file" name="upload_image" id="upload_image" placeholder="Upload image">
            </li>
            <li>
                <label for="nama_barang">Input Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" placeholder="input barang">
            </li>
            <li>
                <label for="harga">Input Harga</label>
                <input type="number" name="harga" id="harga" placeholder="input harga">
            </li>
            <li>
                <button type="submit" name="barang_submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>