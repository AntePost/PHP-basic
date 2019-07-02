<?php

include './session_start.php';
include './functions.php';
include './../config/config.php';

$redirectLocation = './../login.php';

// Check if username field is empty
$message = 'Username field can\'t be empty';
$username = checkIfFieldIsEmpty($_POST['username'], $message, 'login_message');

// Check if password field is empty
$message = 'Password field can\'t be empty';
$password = checkIfFieldIsEmpty($_POST['password'], $message, 'login_message');

// Get relevant user
$relevantUserQuery = "SELECT * FROM users WHERE username = '$username'";
$relevantUser = extractOneRowFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $relevantUserQuery);

// Check if user exists
if (empty($relevantUser)) {
    $message = 'Wrong login';
    SetMessageRedirectAndDie('login_message', $message, $redirectLocation);
}

// Check if password matches
$doesMatch = password_verify($password, $relevantUser['password_hash']);

if ($doesMatch) {
    $_SESSION['isAuth'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $relevantUser['id'];
    $message = 'Login successful';
    SetMessageRedirectAndDie('login_message', $message, $redirectLocation);
} else {
    $message = 'Wrong password';
    SetMessageRedirectAndDie('login_message', $message, $redirectLocation);
}