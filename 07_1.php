<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/07_1.txt');
$start_numbers = array_map(function ($v) {return (int)$v;}, explode(',', $file_input->getLine()));

$pos = 0;
$max_pos = array_reduce($start_numbers, function ($carry, $value) {return $value > $carry ? $value : $carry;}, 0);
$max_fuel = null;

for ($p = 0; $p < $max_pos; $p++) {
    $fuel = 0;
    foreach ($start_numbers as $number) {
        $fuel += abs($number - $p);
    }
    if (null === $max_fuel || $fuel < $max_fuel) {
        $max_fuel = $fuel;
    }
}

echo sprintf("%d\n", $max_fuel);
