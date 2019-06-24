<?php

include('./functions.php');
$product_id = htmlspecialchars($_GET["product_id"]);
$reviewAuthorNames = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT id, author_name FROM reviews WHERE product_id = $product_id");

echo json_encode($reviewAuthorNames);