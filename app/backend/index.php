<?php

$digits = [rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6)];
sort($digits);
$digitCount = array_count_values($digits); // [digit => count]
$digitCountValues = array_values($digitCount);
$digitCountValuesString = implode('', $digitCountValues);
$digitString = implode('', array_unique(array_keys($digitCount)));
$result = '';
$combinations = [
    ['seq' => '12345|23456', 'result' => 'Large Straight', 'straight' => true],
    ['seq' => '1234|2345|3456', 'result' => 'Small Straight', 'straight' => true],
    ['seq' => '5', 'result' => 'YAHTZEE'],
    ['seq' => '4', 'result' => '4 of a Kind'],
    ['seq' => '23|32', 'result' => 'Full House'],
    ['seq' => '3', 'result' => '3 of a Kind'],
    ['seq' => '22', 'result' => 'Two Pairs'],
    ['seq' => '2', 'result' => 'Pair'],
];

foreach ($combinations as $c) {
    $success = (bool)preg_match(
        "/(" . $c['seq'] . ")/",
        $c['straight'] ? $digitString : str_replace('1', '', $digitCountValuesString),
        $matches,
    );

    if ($success) {
        $result = $c['result'];

        if (!$c['straight']) {
            $matches[1] = implode('', array_keys(
                array_filter(
                    $digitCount,
                    fn ($v, $k) => $v > 1,
                    ARRAY_FILTER_USE_BOTH,
                )
            ));
        }
        break;
    }
}

echo json_encode(['attempt' => $digits, 'matches' => $matches[1] ?? [], 'text' => $result ?: 'Chance']);
exit;
