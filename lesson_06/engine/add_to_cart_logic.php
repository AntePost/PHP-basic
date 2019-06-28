<?php

include "functions.php";
include './session_start.php';

// Recieve request
$requestContent = file_get_contents("php://input");
$decoded = json_decode($requestContent, true);
$productId = $decoded['product_id'];
$userId = $_SESSION['user_id'];

// Check if product already exists in cart
$productAlreadyExistsQuery = "SELECT EXISTS (SELECT 1 FROM cart WHERE product_id = '$productId' AND user_id = '$userId') as result";
$doesProductAlreadyExists = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $productAlreadyExistsQuery);

if ($doesProductAlreadyExists[0]['result'] === '0') {
    // If product is not in cart
    $insertProductInCartQuery = "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES ('$userId', '$productId', 1)";
    updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $insertProductInCartQuery);

    $extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
    $cartProducts = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $extactCartQuery);

    echo json_encode($cartProducts);
} else {
    // If product is in cart
    $updateQuanitityQuery = "UPDATE `cart` SET `quantity`= quantity + 1 WHERE product_id = '$productId' AND user_id = '$userId'";
    updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $updateQuanitityQuery);

    $extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
    $cartProducts = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $extactCartQuery);

    echo json_encode($cartProducts);
}