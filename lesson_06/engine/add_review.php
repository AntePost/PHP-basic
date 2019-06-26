<?php

include "functions.php";

$product_id = htmlspecialchars($_GET["product_id"]);
$author_name = htmlspecialchars($_POST["author_name"]);
$text = htmlspecialchars($_POST["text"]);

$query = "INSERT INTO `reviews`(`product_id`, `author_name`, `text`) VALUES ('$product_id', '$author_name', '$text')";

$result = updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $query);

header("Location: ./../product.php?id=$product_id");