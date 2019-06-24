<?php

include('./functions.php');
$author_name = htmlspecialchars($_GET["author_name"]);
$text = htmlspecialchars($_GET["text"]);
$review_id = htmlspecialchars($_GET["review_id"]);

$query = "UPDATE `reviews` SET `author_name`='$author_name' ,`text`='$text' WHERE id = $review_id";

updateMYSQL('localhost', 'root', 'mysql', 'php_basic', $query);

header("Location: ./../admin.php");