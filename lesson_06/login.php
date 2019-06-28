<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="./engine/login_logic.php" method="post">
        <label for="username">Enter a username</label>
        <input type="text" name="username" id="username">

        <label for="password">Enter a password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Login">

        <?php // Чтобы приперезагрузке после логина выводилось нужное сообщение
        if(empty($_SESSION['login_message'])) $_SESSION['login_message'] = 'Enter your username and password'; ?>
        <p id="login_message"><?=$_SESSION['login_message']?></p>
        <?php // Чтобы при перезагрузке страницы выводилось нужное сообщение
        $_SESSION['login_message'] = 'Enter your username and password'; ?>
    </form>
</body>
</html>