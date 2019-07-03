<?php

include "functions.php";
include './../config/config.php';

$review_id = protectAgainstMYSQLInject($_GET["review_id"]);
$product_id = protectAgainstMYSQLInject($_GET["product_id"]);

$query = "DELETE FROM `reviews` WHERE id = '$review_id'";
updateMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $query);

header("Location: ./../product.php?id=$product_id");