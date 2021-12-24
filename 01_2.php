<?php declare(strict_types=1);

$file_input = fopen(__DIR__.'/input/01_2.txt', 'r');

$data = [];
$last_sum = null;
$increased_cnt = 0;
while ($input = fgets($file_input)) {
    if (!trim($input)) {
        continue;
    }

    $input = (int)$input;
    $data[] = [$input];
    $cnt = count($data);
    if (2 <= $cnt) {
        $data[0][] = $input;
    }
    if (3 == $cnt) {
        $data[1][] = $input;
    }
    if (3 === count($data[0])) {
        $sum = array_sum($data[0]);
        array_shift($data);
        if (null !== $last_sum && $sum > $last_sum) {
            $increased_cnt++;
        }
        $last_sum = $sum;
    }
}

fclose($file_input);

echo sprintf("%d\n", $increased_cnt);
