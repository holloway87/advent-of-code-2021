<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/06_1.txt');

$day = 0;
$fish = array_map(function ($v) {return (int)$v;}, explode(',', $file_input->getLine()));

do {
    $cnt = count($fish);
    for ($f = 0; $f < $cnt; $f++) {
        if (0 === $fish[$f]) {
            $fish[] = 8;
            $fish[$f] = 7;
        }
        $fish[$f]--;
    }

    $day++;
} while (80 > $day);

echo sprintf("%d\n", count($fish));
