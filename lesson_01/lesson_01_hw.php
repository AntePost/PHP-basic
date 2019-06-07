<?php
// Задание 2
const BR = '<br/>';

// Использование переменных
$name = 'GeekBrains user';
echo "Hello, $name" . BR;

// Системы счисления
$int10 = 42;
$int2 = 0b101010;
$int8 = 052;
$int16 = 0x2A;
echo "Десятеричная система $int10 <br>";
echo "Двоичная система $int2 <br>";
echo "Восьмеричная система $int8 <br>";
echo "Шестнадцатеричная система $int16 <br>";

// Числа с плавающей точкой
$precise1 = 1.5;
$precise2 = 1.5e4;
$precise3 = 6E-8;
echo "$precise1 | $precise2 | $precise3" . BR;

// Одинарные и двойные кавычки
$a = 1;
echo "$a" . BR;
echo '$a' . BR;

// Явное приведение типов
$a = 10;
$b = (boolean) $b;

// Конкатенация
$a = 'Hello,';
$b = 'world';
$c = $a . $b;
echo $c . BR;

// Арифметические операции
$a = 6;
$b = 5;
echo $a + $b . '<br>';    // сложение
echo $a * $b . '<br>';    // умножение
//echo ($a -­ $b) . '<br>';    // вычитание
echo $a / $b . '<br>';  // деление
echo $a % $b . '<br>'; // остаток от деления
echo $a ** $b . '<br>'; // возведение в степень

// Краткие записи и инкремент
$a = 4;
$b = 5;
$a += $b;
echo 'a = ' . $a . BR;
$a = 0;
echo $a++ . BR;     // Постинкремент
echo ++$a . BR;    // Преинкремент
echo $a­­-- . BR;     // Постдекремент
// echo ­­--$a . BR;    // Предекремент

// Логические операции
$a = 4;
$b = 5;
var_dump($a == $b);  // Сравнение по значению
var_dump($a === $b); // Сравнение по значению и типу
var_dump($a > $b);    // Больше
var_dump($a < $b);    // Меньше
var_dump($a <> $b);  // Не равно
var_dump($a != $b);   // Не равно
var_dump($a !== $b); // Не равно без приведения типов
var_dump($a <= $b);  // Меньше или равно
var_dump($a >= $b);  // Больше или равно

// Задание 3
$a = 5;
$b = '05';
// Произошло приведение неявное приведение типов
var_dump($a == $b);                             // Почему true?
// При преобразовании в integer ноль убирается, так как он не несет полезной нагрузки
var_dump((int)'012345');                        // Почему 12345?
// Сравнение идет по значениям и типам, типы разные
var_dump((float)123.0 === (int)123.0); // Почему false?
// Видимо любая строка, не содержащая чисел в начале, приводится к 0
var_dump((int)0 === (int)'hello, world'); // Почему true?
?>

<?php
// Задание 4
$h1 = '<h1>Я заголовок</h1>';
$title = '<title>Я тоже</title>';
$date = getdate();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php echo $title ?>
  </head>
  <body>
    <?php echo $h1 ?>
    <h2><?php echo "$date[hours]:$date[minutes]" ?></h2>
  </body>
</html>

<?php
// Задание 5 (работает для PHP 7.1 и выше)
$a = 1;
$b = 2;
[$a, $b] = [$b, $a];
echo $a . BR;
echo $b . BR;
