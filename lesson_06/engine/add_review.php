<?php

include "functions.php";
include './../config/config.php';

$product_id = protectAgainstMYSQLInject($_GET["product_id"]);
$author_name = protectAgainstMYSQLInject($_POST["author_name"]);
$text = protectAgainstMYSQLInject($_POST["text"]);

$query = "INSERT INTO `reviews`(`product_id`, `author_name`, `text`) VALUES ('$product_id', '$author_name', '$text')";
updateMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $query);

header("Location: ./../product.php?id=$product_id");