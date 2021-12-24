<?php declare(strict_types=1);

$file_input = fopen(__DIR__.'/input/01_1.txt', 'r');

$last_input = null;
$increased_cnt = 0;
while ($input = fgets($file_input)) {
    if (!trim($input)) {
        continue;
    }

    $input = (int)$input;
    if (null !== $last_input && $input > $last_input) {
        $increased_cnt++;
    }
    $last_input = $input;
}

fclose($file_input);

echo sprintf("%d\n", $increased_cnt);
