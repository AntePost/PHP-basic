<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <style>
        .wrapper {
            width: 500px;
            margin: 100px auto 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            align-content: center;
        }

        a {
            font-size: 24px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <a href="./calculator.php">Calculator</a>
        <a href="./catalogue.php">Catalogue</a>
        <a href="./admin.php">Manage reviews</a>
        <a href="./register.php">Register</a>
        <a href="./login.php">Login</a>
        <a href="./logout.php">Logout</a>
        <a href="./cart.php">Cart</a>
    </div>
</body>
</html>