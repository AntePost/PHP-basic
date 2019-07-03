<?php

include "functions.php";
include './session_start.php';
include './../config/config.php';

$userId = $_SESSION['user_id'];

$extactCartQuery = "SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$userId'";
$cartProducts = extractFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $extactCartQuery);

echo json_encode($cartProducts);