<?php

include './session_start.php';
include './functions.php';
include './../config/config.php';

$redirectLocation = './../register.php';

// Check if username field is empty
$emptyUsernameMessage = 'Username field can\'t be empty';
$username = checkIfFieldIsEmpty($_POST['username'], $emptyUsernameMessage, 'register_message');

// Check if password field is empty
$emptyPasswordMessage = 'Password field can\'t be empty';
$password = checkIfFieldIsEmpty($_POST['password'], $emptyPasswordMessage, 'register_message');

// Check if username contains correct symbols
$InvalidUsernameMessage = 'Username must contain only latin characters and numbers';
checkFieldWithRegex($username, $InvalidUsernameMessage);

// Check if password contains correct symbols
$InvalidPasswordMessage = 'Password must contain only latin characters and numbers';
checkFieldWithRegex($password, $InvalidPasswordMessage);

// Check if password is of correct length
if (strlen($password) < 4) {
    $message = 'Password must be at least 8 symbols';
    SetMessageRedirectAndDie('register_message', $message, $redirectLocation);
}

// Check if username already exists
$userAlreadyExistsQuery = "SELECT EXISTS (SELECT 1 FROM users WHERE username = '$username') as result";
$doesUserAlreadyExists = extractOneRowFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $userAlreadyExistsQuery);

if ($doesUserAlreadyExists['result'] === '1') {
    $message = 'Username already taken';
    SetMessageRedirectAndDie('register_message', $message, $redirectLocation);
}

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Add user to database
$addUserQuery = "INSERT INTO `users`(`username`, `password_hash`) VALUES ('$username', '$password_hash')";
$result = updateMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $addUserQuery);

if ($result) {
    $message = 'Registration successful';
    SetMessageRedirectAndDie('register_message', $message, $redirectLocation);
} else {
    $message = 'Something went wrong';
    SetMessageRedirectAndDie('register_message', $message, $redirectLocation);
}