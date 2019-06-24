<?php

include "functions.php";

$cookiename = 'result';
$value = arithOper($_GET['term_1'], $_GET['term_2'], $_GET['operation']);
$expiry = 0;
$path = '/';

setcookie($cookiename, $value, $expiry, $path);

header('Location: ./../calculator.php');