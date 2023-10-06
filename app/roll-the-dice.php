<?php

session_start();
$attempt = [rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6)];
sort($attempt);
$combination_result = '';
$matches = [];
$matchKeys = [];
$colors = ['#ff0000', '#00ff00'];
$sequences = [
    ['seq' => [[1, 2, 3, 4, 5], [2, 3, 4, 5, 6]], 'result' => 'Большой стрит',],
    ['seq' => [[1, 2, 3, 4], [2, 3, 4, 5], [3, 4, 5, 6]], 'result' => 'Малый стрит',],
];

// Проверяем выпадение какого-либо стрита
foreach ($sequences as $seq) {
    foreach ($seq['seq'] as $s) {
        if (count(array_filter($s, function ($v) use ($attempt) {
            return in_array($v, $attempt);
        })) == count($s)) {
            $combination_result = $seq['result'];
            $matchKeys = array_map(function ($v) use ($attempt) {
                return array_search($v, $attempt);
            }, $s);
            break 2;
        }
    }
}

// если стрит не выпал, то ищем одинаковые цифры
if (empty($combination_result)) {
    $combinations = [
        '2' => 'Пара',
        '2,2' => 'Две пары',
        '3' => 'Тройка',
        '3,2' => 'Фулл хаус',
        '2,3' => 'Фулл хаус',
        '4' => 'Каре',
        '5' => 'Покер'
    ];
    $matches = [];
    $processedDigits = [];

    foreach ($attempt as $digit) {
        // если цифра ранее была найдена, то ничего не делаем
        if (isset($matches[$digit]) || in_array($digit, $processedDigits)) {
            continue;
        }

        $count = count(array_filter($attempt, function ($d) use ($digit) {
            return $d == $digit;
        }));

        if ($count > 1) {
            $matches[$digit] = $count;
        }
        $processedDigits[] = $digit;
    }

    $matchKeys = array_keys($matches);
    $combination_result = $combinations[$matches[$matchKeys[0]] . (isset($matches[$matchKeys[1]]) ? ',' . $matches[$matchKeys[1]] : '')];
}

$result = '';
foreach ($attempt as $i => $d) {
    $index = 0;
    if (count($matchKeys) <= 2) {
        $index = array_search($d, $matchKeys);
    } else {
        $index = in_array($i, $matchKeys) ? 0 : false;
    }
    $color = $index !== false ? $colors[$index] : 'black';
    $result .= "<div style='width: 25px; height: 25px; border: 1px solid $color; " .
        "display: flex; justify-content: center; align-items:center; margin-right: 10px; color: $color;'>$d</div>";
}
$_SESSION['result'] = "<div style='display: flex; margin-top: 20px;'>$result</div>" .
    "<div style='margin-top: 10px;'>" . ($combination_result ?: 'Шанс') . "</div>";
header("Location: index.php");
exit;
