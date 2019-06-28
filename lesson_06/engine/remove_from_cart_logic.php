<?php

include "functions.php";
include './session_start.php';

// Recieve request
$requestContent = file_get_contents("php://input");
$decoded = json_decode($requestContent, true);
$productId = $decoded['product_id'];
$userId = $_SESSION['user_id'];

// Check quantity of product
$checkQuantityQuery = "SELECT quantity FROM cart WHERE product_id = '$productId' AND user_id = '$userId'";
$productQuantity = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $checkQuantityQuery);

if ($productQuantity[0]['quantity'] > 1) {
    // If quantity greater than 1 -> update row in DB
    $updateQuanitityQuery = "UPDATE `cart` SET `quantity`= quantity - 1 WHERE product_id = '$productId' AND user_id = '$userId'";
    updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $updateQuanitityQuery);

    $extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
    $cartProducts = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $extactCartQuery);

    echo json_encode($cartProducts);
} else {
    // If quantity greater is 1 -> delete row in DB
    $deleteRowQuery = "DELETE FROM `cart` WHERE product_id = '$productId' AND user_id = '$userId'";
    updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $deleteRowQuery);

    $extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
    $cartProducts = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $extactCartQuery);

    echo json_encode($cartProducts);
}