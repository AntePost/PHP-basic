<?php

include "functions.php";
include './session_start.php';

$userId = $_SESSION['user_id'];

$extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
$cartProducts = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', $extactCartQuery);

echo json_encode($cartProducts);