<?php

include './functions.php';
include './../config/config.php';

$author_name = protectAgainstMYSQLInject($_GET["author_name"]);
$text = protectAgainstMYSQLInject($_GET["text"]);
$review_id = protectAgainstMYSQLInject($_GET["review_id"]);

$query = "UPDATE `reviews` SET `author_name`='$author_name' ,`text`='$text' WHERE id = $review_id";
updateMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $query);

header("Location: ./../admin.php");