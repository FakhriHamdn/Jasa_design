<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Testing</title>
</head>
<html>
<body>
    <h1>Home page mabroooooooo</h1>
    <?php if(isset($_SESSION['request'])): ?>
        <?php foreach($_SESSION['request'] as $row): ?>
            <?php echo $row[0]; ?>
            <?php echo $row[1]; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
</html>