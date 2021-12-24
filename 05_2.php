<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/05_2.txt');

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
    if (!$valid) {
        continue;
    }

    $x_op = +1;
    if ($points[0][0] > $points[1][0]) {
        $x_op = -1;
    }
    $y_op = +1;
    if ($points[0][1] > $points[1][1]) {
        $y_op = -1;
    }
    $check_x = function ($x, $points) use ($x_op) {
        return 1 === $x_op ? $x <= $points[1][0] : $x >= $points[1][0];
    };
    $check_y = function ($y, $points) use ($y_op) {
        return 1 === $y_op ? $y <= $points[1][1] : $y >= $points[1][1];
    };

    $x = $points[0][0];
    $y = $points[0][1];
    while ($check_x($x, $points) && $check_y($y, $points)) {
        if (!array_key_exists($y, $matrix)) {
            $matrix[$y] = [];
        }
        if (!array_key_exists($x, $matrix[$y])) {
            $matrix[$y][$x] = 0;
        }
        $matrix[$y][$x]++;

        if ($points[0][0] !== $points[1][0]) {
            $x = $x + $x_op;
        }
        if ($points[0][1] !== $points[1][1]) {
            $y = $y + $y_op;
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
