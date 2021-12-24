<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/05_1.txt');

$matrix = [];
while ($line = $file_input->getLine()) {
    $points = explode(' -> ', $line);
    if (2 != count($points)) {
        continue;
    }

    $valid = true;
    foreach ($points as $idx => $point) {
        $points[$idx] = array_map(function ($v) {return (int)$v;}, explode(',', $point));
        if (2 !== count($points[$idx])) {
            $valid = false;

            break;
        }
    }
    if (!$valid || !($points[0][0] === $points[1][0] || $points[0][1] === $points[1][1])) {
        continue;
    }

    if ($points[0][0] > $points[1][0] || $points[0][1] > $points[1][1]) {
        $tmp = $points[0];
        $points[0] = $points[1];
        $points[1] = $tmp;
    }

    for ($y = $points[0][1]; $y <= $points[1][1]; $y++) {
        for ($x = $points[0][0]; $x <= $points[1][0]; $x++) {
            if (!array_key_exists($y, $matrix)) {
                $matrix[$y] = [];
            }
            if (!array_key_exists($x, $matrix[$y])) {
                $matrix[$y][$x] = 0;
            }
            $matrix[$y][$x]++;
        }
    }
}

$sum = 0;
foreach ($matrix as $cols) {
    foreach ($cols as $value) {
        if (2 <= $value) {
            $sum++;
        }
    }
}

echo sprintf("%d\n", $sum);
