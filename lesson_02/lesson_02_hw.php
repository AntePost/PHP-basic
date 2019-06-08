<?php
// Задание №1

$a = 0;
$b = 5;

if ($a >= 0 and $b >= 0) {
  echo $a - $b . PHP_EOL;
} elseif ($a < 0 and $b < 0) {
  echo $a * $b . PHP_EOL;
} else {
  echo $a + $b . PHP_EOL;
}

// Задание №2

$c = 7;

switch ($c) {
  case 0:
    echo $c . PHP_EOL;
    $c++;
  case 1:
    echo $c . PHP_EOL;
    $c++;
  case 2:
    echo $c . PHP_EOL;
    $c++;
  case 3:
    echo $c . PHP_EOL;
    $c++;
  case 4:
    echo $c . PHP_EOL;
    $c++;
  case 5:
    echo $c . PHP_EOL;
    $c++;
  case 6:
    echo $c . PHP_EOL;
    $c++;
  case 7:
    echo $c . PHP_EOL;
    $c++;
  case 8:
    echo $c . PHP_EOL;
    $c++;
  case 9:
    echo $c . PHP_EOL;
    $c++;
  case 10:
    echo $c . PHP_EOL;
    $c++;
  case 11:
    echo $c . PHP_EOL;
    $c++;
  case 12:
    echo $c . PHP_EOL;
    $c++;
  case 13:
    echo $c . PHP_EOL;
    $c++;
  case 14:
    echo $c . PHP_EOL;
    $c++;
  case 15:
    echo $c . PHP_EOL;
    $c++;
}

// Задание №3

function addition($addent1, $addent2) {
  if (!is_numeric($addent1) or !is_numeric($addent2)) {
    echo 'Not a valid input';
    return;
  }
  return $addent1 + $addent2;
}

function subtraction($minuend, $subtrahend) {
  if (!is_numeric($minuend) or !is_numeric($subtrahend)) {
    echo 'Not a valid input';
    return;
  }
  return $minuend - $subtrahend;
}

function multiplication($factor1, $factor2) {
  if (!is_numeric($factor1) or !is_numeric($factor2)) {
    echo 'Not a valid input';
    return;
  }
  return $factor1 * $factor2;
}

function division($dividend, $divisor) {
  if (!is_numeric($dividend) or !is_numeric($divisor)) {
    echo 'Not a valid input';
    return;
  }
  if ($divisor === 0) {
    echo 'Attempt to divide by zero';
    return;
  }
  return $dividend / $divisor;
}

// Задание №4

function arithOper($term1, $term2, $operation) {
  switch ($operation) {
    case 'add':
      return addition($term1, $term2);
      break;
    case 'sub':
      return subtraction($term1, $term2);
      break;
    case 'mul':
      return multiplication($term1, $term2);
      break;
    case 'div':
      return division($term1, $term2);
      break;
    default:
      echo 'Not a valid operation';
      break;
  }
}

echo arithOper(1, 5, 'add') . PHP_EOL;
echo arithOper('hello', 5, 'add') . PHP_EOL;
echo arithOper(1, 5, 'sub') . PHP_EOL;
echo arithOper(1, 5, 'mul') . PHP_EOL;
echo arithOper(1, 5, 'div') . PHP_EOL;
echo arithOper(1, 0, 'div') . PHP_EOL;
echo arithOper(1, 5, 'abc') . PHP_EOL;

// Задание №5
// Уже делал на прошлом уроке.

// Задание №6

function power($val, $pow) {
  if (!is_numeric($val) or !is_numeric($pow)) {
    echo 'Not a valid input';
    return;
  }
  if ($pow === 1) {
    return $val;
  }
  return $val * power($val, $pow - 1);
}

echo power(2, 5) . PHP_EOL;

// Задание №7

function getFormattedDate() {
  $currentTime = getdate();
  return "Сейчас $currentTime[hours] " . getCorrectDeclension('час', $currentTime['hours'], 'second') . " $currentTime[minutes] " . getCorrectDeclension('минута', $currentTime['minutes'], 'first') . " $currentTime[seconds] " . getCorrectDeclension('секунда', $currentTime['seconds'], 'first');
}

function getCorrectDeclension($word, $time, $decl) {
  switch ($decl) {
    case 'first':
      if (preg_match('/1\d$/', $time)) {
        return mb_substr($word, 0, -1);
      } elseif (preg_match('/1$/', $time)) {
        return $word;
      } elseif (preg_match('/[2-4]$/', $time)) {
        return mb_substr($word, 0, -1) . 'ы';
      } else {
        return mb_substr($word, 0, -1);
      }
    case 'second':
      if (preg_match('/1\d$/', $time)) {
        return $word . 'ов';
      } elseif (preg_match('/1$/', $time)) {
        return $word;
      } elseif (preg_match('/[2-4]$/', $time)) {
        return $word . 'а';
      } else {
        return $word . 'ов';
      }
  }
}

echo getFormattedDate();