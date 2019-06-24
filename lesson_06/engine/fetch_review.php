<?php

include('./functions.php');
$review_id = htmlspecialchars($_GET["review_id"]);
$relevantReview = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT id, author_name, text FROM reviews WHERE id = $review_id");

echo json_encode($relevantReview);