<?php

include './functions.php';
include './../config/config.php';

$product_id = protectAgainstMYSQLInject($_GET["product_id"]);

$query = "SELECT id, author_name FROM reviews WHERE product_id = $product_id";
$reviewAuthorNames = extractFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $query);

echo json_encode($reviewAuthorNames);