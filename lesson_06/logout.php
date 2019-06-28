<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logout</title>
</head>
<body>
    <?php if($_SESSION['isAuth']) : ?>
        <h2>Hello, <?=$_SESSION['username']?></h2>
        <form action="./engine/logout_logic.php" method="get">
            <input type="submit" value="Logout" id="logout-button">
        </form>
    <?php else : ?>
        <h2>Access denied</h2>
    <?php endif ?>

    <script>

        const logoutButton = document.getElementById('logout-button');
        logoutButton.addEventListener('click', () => {
            localStorage.clear();
        });
    
    </script>
</body>
</html>