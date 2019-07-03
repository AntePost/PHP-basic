<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="./engine/register_logic.php" method="post">
        <label for="username">Enter a username</label>
        <input type="text" name="username" id="username">
        <p>Only latin characters and numbers</p>

        <label for="password">Enter a password</label>
        <input type="password" name="password" id="password">
        <p>Only latin characters and numbers. Minimum 4 symbols</p>

        <input type="submit" value="Register">

        <p id="register_message"><?=$_SESSION['register_message']?></p>
        <?php // Чтобы при перезагрузке страницы выводилось нужное сообщение
        $_SESSION['register_message'] = 'Come up with username and password'; ?>
    </form>
</body>
</html>