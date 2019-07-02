<?php

include('./session_start.php');
include('./functions.php');

// Check if username field is empty
if (!empty($_POST['username'])) {
    $username = strip_tags(htmlspecialchars($_POST['username']));
} else {
    $_SESSION['login_message'] = 'Username field can\'t be empty';
    header("Location: ./../login.php");
    die;
}

// Check if password field is empty
if (!empty($_POST['password'])) {
    $password = strip_tags(htmlspecialchars($_POST['password']));
} else {
    $_SESSION['login_message'] = 'Password field can\'t be empty';
    header("Location: ./../login.php");
    die;
}

// Get relevant user
$relevantUser = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM users WHERE username = '$username'");

// Check if user exists
if (empty($relevantUser)) {
    $_SESSION['login_message'] = 'Wrong login';
    header("Location: ./../login.php");
    die;
}

// Check if password matches
$doesMatch = password_verify($password, $relevantUser[0]['password_hash']);

if ($doesMatch) {
    $_SESSION['login_message'] = 'Login successful';
    $_SESSION['isAuth'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $relevantUser[0]['id'];
    header("Location: ./../login.php");
    die; 
} else {
    $_SESSION['login_message'] = 'Wrong password';
    header("Location: ./../login.php");
    die;
}