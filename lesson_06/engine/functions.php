<?php

function addition($addent1, $addent2) {
    if (!is_numeric($addent1) or !is_numeric($addent2)) {
        return 'Not a valid input';
    }
    return $addent1 + $addent2;
}
  
function subtraction($minuend, $subtrahend) {
    if (!is_numeric($minuend) or !is_numeric($subtrahend)) {
        return 'Not a valid input';
    }
    return $minuend - $subtrahend;
}
  
function multiplication($factor1, $factor2) {
    if (!is_numeric($factor1) or !is_numeric($factor2)) {
        return 'Not a valid input';
    }
    return $factor1 * $factor2;
}
  
function division($dividend, $divisor) {
    if (!is_numeric($dividend) or !is_numeric($divisor)) {
        return 'Not a valid input';
    }
    if ($divisor == 0) {
        return 'Attempt to divide by zero';
    }
    return $dividend / $divisor;
}

function arithOper($term1, $term2, $operation) {
    switch ($operation) {
        case 'add':
            return addition($term1, $term2);
            break;
        case 'sub':
            return subtraction($term1, $term2);
            break;
        case 'mul':
            return multiplication($term1, $term2);
            break;
        case 'div':
            return division($term1, $term2);
            break;
        default:
            return 'Not a valid operation';
            break;
    }
}

function extractFromMYSQL($addr, $username, $password, $DBName, $query) {
    $link = mysqli_connect($addr, $username, $password, $DBName);

    $result = mysqli_query($link, $query);
    $array = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    mysqli_close($link);

    return $array;
}

function extractOneRowFromMYSQL($addr, $username, $password, $DBName, $query) {
    $link = mysqli_connect($addr, $username, $password, $DBName);

    $result = mysqli_query($link, $query);

    mysqli_close($link);

    return mysqli_fetch_assoc($result);
}

function updateMYSQL($addr, $username, $password, $DBName, $query) {
    $link = mysqli_connect($addr, $username, $password, $DBName);
    $result = mysqli_query($link, $query);
    mysqli_close($link);
    return $result;
}

function protectAgainstMYSQLInject($str) {
    return strip_tags(htmlspecialchars($str));
}

function parseJSON() {
    $requestContent = file_get_contents("php://input");
    return json_decode($requestContent, true);
}

function updateCartExtractAndSendJSON($firstQuery) {
    updateMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $firstQuery);

    global $userId;
    $extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
    $cartProducts = extractFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $extactCartQuery);

    echo json_encode($cartProducts);
}

function SetMessageRedirectAndDie($messageType, $message, $location) {
    $_SESSION[$messageType] = $message;
    header("Location: $location");
    die;
}

function checkIfFieldIsEmpty($field, $message, $messageType) {
    if (!empty($field)) {
        return protectAgainstMYSQLInject($field);
    } else {
        global $redirectLocation;
        SetMessageRedirectAndDie($messageType, $message, $redirectLocation);
    }
}

function checkFieldWithRegex($str, $message) {
    if (preg_match('/[a-zA-Z0-9]/', $str) === 0) {
        global $redirectLocation;
        SetMessageRedirectAndDie('register_message', $message, $redirectLocation);
    }
}