<?php

include('./session_start.php');
include('./functions.php');

// Check if username field is empty
if (!empty($_POST['username'])) {
    $username = strip_tags(htmlspecialchars($_POST['username']));
} else {
    $_SESSION['register_message'] = 'Username field can\'t be empty';
    header("Location: ./../register.php");
    die; 
}

// Check if password field is empty
if (!empty($_POST['password'])) {
    $password = strip_tags(htmlspecialchars($_POST['password']));
} else {
    $_SESSION['register_message'] = 'Password field can\'t be empty';
    header("Location: ./../register.php");
    die; 
}

// Check if username contains correct symbols
if (preg_match('/[a-zA-Z0-9]/', $username) === 0) {
    $_SESSION['register_message'] = 'Username must contain only latin characters and numbers';
    //header("Location: ./../register.php");
    die;
}

// Check if password contains correct symbols
if (preg_match('/[a-zA-Z0-9]/', $password) === 0) {
    $_SESSION['register_message'] = 'Password must contain only latin characters and numbers';
    header("Location: ./../register.php");
    die;
}

// Check if password is of correct length
if (strlen($password) < 8) {
    $_SESSION['register_message'] = 'Password must be at least 8 symbols';
    header("Location: ./../register.php");
    die;
}

// Check if username already exists
$userAlreadyExistsQuery = "SELECT EXISTS (SELECT 1 FROM users WHERE username = '$username') as result";
$doesUserAlreadyExists = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $userAlreadyExistsQuery);

if ($doesUserAlreadyExists[0]['result'] === '1') {
    $_SESSION['register_message'] = 'Username already taken';
    header("Location: ./../register.php");
    die;
}

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Add user to database
$addUserQuery = "INSERT INTO `users`(`username`, `password_hash`) VALUES ('$username', '$password_hash')";
$result = updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $addUserQuery);
if ($result) {
    $_SESSION['register_message'] = 'Registration successful';
    header("Location: ./../register.php");
    die;
} else {
    $_SESSION['register_message'] = 'Something went wrong';
    header("Location: ./../register.php");
    die;
}