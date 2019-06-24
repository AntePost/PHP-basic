<?php

include "functions.php";

$review_id = htmlspecialchars($_GET["review_id"]);
$product_id = htmlspecialchars($_GET["product_id"]);

$query = "DELETE FROM `reviews` WHERE id = '$review_id'";

updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $query);

header("Location: ./../product.php?id=$product_id");