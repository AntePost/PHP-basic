<?php

include './functions.php';
include './../config/config.php';

$review_id = protectAgainstMYSQLInject($_GET["review_id"]);

$query = "SELECT id, author_name, text FROM reviews WHERE id = $review_id";
$relevantReview = extractFromMYSQL(dbAccess['addr'], dbAccess['username'], dbAccess['password'], dbAccess['DBName'], $query);

echo json_encode($relevantReview);