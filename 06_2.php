<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/06_2.txt');
$start_numbers = array_map(function ($v) {return (int)$v;}, explode(',', $file_input->getLine()));

$numbers = array_fill(0, 9, 0);

foreach ($start_numbers as $number) {
    $numbers[$number]++;
}

$day = 0;
do {
    $new_numbers = array_fill(0, 9, 0);
    $new_fish = $numbers[0];

    for ($n = 8; $n > 0; $n--) {
        $new_numbers[$n -1] = $numbers[$n];
    }
    $new_numbers[8] = $new_fish;
    $new_numbers[6] = $new_numbers[6] + $new_fish;

    $numbers = $new_numbers;
    $day++;
} while (256 > $day);

echo sprintf("%d\n", array_sum($numbers));
