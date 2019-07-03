<?php

include "functions.php";
include './session_start.php';
include './../config/config.php';

// Recieve request
$decoded = parseJSON();
$productId = protectAgainstMYSQLInject($decoded['product_id']);
$userId = $_SESSION['user_id'];

// Check if product already exists in cart
$productAlreadyExistsQuery = "SELECT EXISTS (SELECT 1 FROM cart WHERE product_id = '$productId' AND user_id = '$userId') as result";
$doesProductAlreadyExists = extractOneRowFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $productAlreadyExistsQuery);

if ($doesProductAlreadyExists['result'] === '0') {
    // If product is not in cart
    $insertProductInCartQuery = "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES ('$userId', '$productId', 1)";
    updateCartExtractAndSendJSON($insertProductInCartQuery);
} else {
    // If product is in cart
    $updateQuanitityQuery = "UPDATE `cart` SET `quantity`= quantity + 1 WHERE product_id = '$productId' AND user_id = '$userId'";
    updateCartExtractAndSendJSON($updateQuanitityQuery);
}