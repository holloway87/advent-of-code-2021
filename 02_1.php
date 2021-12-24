<?php declare(strict_types=1);

$file_input = fopen(__DIR__.'/input/02_1.txt', 'r');

$depth_sum = 0;
$horizontal_sum = 0;
while ($input = fgets($file_input)) {
    $input = trim($input);
    if (!$input) {
        continue;
    }

    $input = explode(' ', $input);
    if (2 != count($input)) {
        continue;
    }
    $command = trim(mb_strtolower($input[0]));
    $value = (int)trim($input[1]);
    switch ($command) {
        case 'forward':
            $horizontal_sum += $value;
            break;
        case 'down':
            $depth_sum += $value;
            break;
        case 'up':
            $depth_sum -= $value;
            break;
    }
}

fclose($file_input);

echo sprintf("%d\n", ($depth_sum * $horizontal_sum));
