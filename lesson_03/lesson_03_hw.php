<?php

// Задание №1

$a = 0;
const END_OF_WHILE = 100;

while ($a <= END_OF_WHILE) {
    if ($a % 3 === 0) {
        echo $a . PHP_EOL;
    }
    $a++;
}

// Задание №2

$b = 0;
const END_OF_DOWHILE = 10;
do {
    if ($b === 0) {
        echo "$b - это ноль" . PHP_EOL;
    } elseif ($b % 2 === 0) {
        echo "$b - это четное число" . PHP_EOL;
    } elseif ($b % 2 !== 0) {
        echo "$b - это нечетное число" . PHP_EOL;
    }
    $b++;
} while ($b <= END_OF_DOWHILE);

// Задание №3

$oblastArr = [
    'Московская область' => [
        0 => 'Москва',
        1 => 'Зеленоград',
        2 => 'Клин',
    ],
    'Ленинградская область' => [
        0 => 'Санкт-Петербург',
        1 => 'Всеволожск',
        2 => 'Павловск',
        3 => 'Кронштадт',
    ],
    'Рязанская область' => [
        0 => 'Рязань',
        1 => 'Касимов',
        2 => 'Скопин',
        3 => 'Сасово',
    ]
];

foreach ($oblastArr as $key => $value) {
    echo $key . ':' . PHP_EOL;
    $citiesList = '';
    $obslastInnerArrLength = count($value);
    
    for ($i=0; $i < $obslastInnerArrLength; $i++) { 
        $citiesList = $citiesList . $value[$i] . ', ';
    }
    echo mb_substr($citiesList, 0, -2) . '.' . PHP_EOL;
}

// Задание №4

$translit = [
    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'je',
    'ё' => 'jo',
    'ж' => 'zh',
    'з' => 'z',
    'и' => 'i',
    'й' => 'j',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'u',
    'ф' => 'f',
    'х' => 'kh',
    'ц' => 'ts',
    'ч' => 'ch',
    'ш' => 'sh',
    'щ' => 'shch',
    'ъ' => '"',
    'ы' => 'y',
    'ь' => '\'',
    'э' => 'eh',
    'ю' => 'ju',
    'я' => 'ja',
];

function transliteration($sentence) {
    global $translit;
    $sentence = mb_strtolower($sentence);
    $sentenceArr = preg_split('//u', $sentence, null, PREG_SPLIT_NO_EMPTY);
    $translitSentence = [];
    $sentenceArrLength = count($sentenceArr);

    for ($i=0; $i < $sentenceArrLength; $i++) {
        if (array_key_exists($sentenceArr[$i], $translit)) {
            $translitSentence[] = $translit[$sentenceArr[$i]];
        } else {
            $translitSentence[] = $sentenceArr[$i];
        }
    }

    return implode('', $translitSentence);
}

echo transliteration('Съешь же ещё этих мягких французских булок да выпей чаю.') . PHP_EOL;

// Задание №5

function spacesToUnderscores($sentence) {
    $sentenceArr = preg_split('//u', $sentence, null, PREG_SPLIT_NO_EMPTY);
    $underscoreSentence = [];
    $sentenceArrLength = count($sentenceArr);

    for ($i=0; $i < $sentenceArrLength; $i++) { 
        if ($sentenceArr[$i] === ' ') {
            $underscoreSentence[] = '_';
        } else {
            $underscoreSentence[] = $sentenceArr[$i];
        }
    }

    return implode('', $underscoreSentence);
}

echo spacesToUnderscores('Съешь же ещё этих мягких французских булок да выпей чаю.') . PHP_EOL;
?>

<?php // Задание №6 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php
        // Первый вариант с одним блоком php
        const END_OF_FOR = 10;
        for ($i=0; $i < END_OF_FOR; $i++) { 
            //echo "<li>I'm *li* number $i</li>";

            echo "<li>I'm *ul* number $i<ul>";
                for ($j=0; $j < END_OF_FOR; $j++) { 
                    echo "<li>I'm *li* number $j</li>";
                }
            echo '</ul></li>';
        }
        ?>

        <?php
        // Второй вариант с множественными блоками php
        for ($i=0; $i < END_OF_FOR; $i++) : ?>
        <li>I'm *ul* number <?=$i?>
        <ul>
            <?php for ($j=0; $j < END_OF_FOR; $j++) : ?>
            <li>I'm *li* number <?=$j?></li>
            <?php endfor; ?>
        </ul>
        </li>
        <?php endfor; ?>
    </ul>
</body>
</html>

<?php

// Задание №7

for ($i=0; $i < END_OF_FOR; print $i . PHP_EOL, $i++) { 
    # code...
}

// Задание №8

foreach ($oblastArr as $key => $value) {
    echo $key . ':' . PHP_EOL;
    $citiesList = '';
    $obslastInnerArrLength = count($value);

    for ($i=0; $i < $obslastInnerArrLength; $i++) { 
        if (mb_substr($value[$i], 0, 1) === 'К') {
            $citiesList = $citiesList . $value[$i] . ', ';
        }
    }
    echo mb_substr($citiesList, 0, -2) . '.' . PHP_EOL;
}

// Задание №9

function formatForURL($sentence) {
    $transliterated = transliteration($sentence);
    return spacesToUnderscores($transliterated);
}

echo formatForURL('Съешь же ещё этих мягких французских булок да выпей чаю.') . PHP_EOL;