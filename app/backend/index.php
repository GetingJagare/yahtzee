<?php

$attempt = [rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6)];
sort($attempt);
$combination_result = '';
$matches = $matchKeys = [];
$sequences = [
    ['seq' => [[1, 2, 3, 4, 5], [2, 3, 4, 5, 6]], 'result' => 'Large Straight',],
    ['seq' => [[1, 2, 3, 4], [2, 3, 4, 5], [3, 4, 5, 6]], 'result' => 'Small Straight',],
];

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

if (empty($combination_result)) {
    $combinations = [
        '2' => 'Pair',
        '2,2' => 'Two Pairs',
        '3' => '3 of a Kind',
        '3,2' => 'Full House',
        '2,3' => 'Full House',
        '4' => '4 of a Kind',
        '5' => 'YAHTZEE'
    ];
    $matches = [];
    $processedDigits = [];

    foreach ($attempt as $digit) {
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

echo json_encode([
    'attempt' => $attempt,
    'matches' => $matchKeys,
    'text' => $combination_result ?: 'Chance',
]);
exit;