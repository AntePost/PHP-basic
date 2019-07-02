<?php

include "functions.php";
include './session_start.php';
include './../config/config.php';

// Recieve request
$decoded = parseJSON();
$productId = 1; //protectAgainstMYSQLInject($decoded['product_id']);
$userId = $_SESSION['user_id'];

// Check quantity of product
$checkQuantityQuery = "SELECT quantity FROM cart WHERE product_id = '$productId' AND user_id = '$userId'";
$productQuantity = extractOneRowFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $checkQuantityQuery);

if ($productQuantity['quantity'] > 1) {
    // If quantity greater than 1 -> update row in DB
    $updateQuanitityQuery = "UPDATE `cart` SET `quantity`= quantity - 1 WHERE product_id = '$productId' AND user_id = '$userId'";
    updateCartExtractAndSendJSON($updateQuanitityQuery);
} else {
    // If quantity greater is 1 -> delete row in DB
    $deleteRowQuery = "DELETE FROM `cart` WHERE product_id = '$productId' AND user_id = '$userId'";
    updateCartExtractAndSendJSON($deleteRowQuery);
}