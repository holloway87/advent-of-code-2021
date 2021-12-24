<?php declare(strict_types=1);

require_once __DIR__.'/BinaryData.php';
require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/03_2.txt');
$input_data = $file_input->readAllLines();

function filter_bit_input(array $input_data, int $bit_pos, $most_common): array {
    $output = [];
    $most_common = BinaryData::calcBitData($input_data, $bit_pos, $most_common);
    foreach ($input_data as $input) {
        if ($most_common === $input[$bit_pos]) {
            $output[] = $input;
        }
    }

    return $output;
}

$oxygen_bit_data = $input_data;
$bit_pos = 0;
while (1 !== count($oxygen_bit_data)) {
    $oxygen_bit_data = filter_bit_input($oxygen_bit_data, $bit_pos, true);
    $bit_pos++;
    if ($bit_pos === strlen($input_data[0])) {
        break;
    }
}

$co2_bit_data = $input_data;
$bit_pos = 0;
while (1 !== count($co2_bit_data)) {
    $co2_bit_data = filter_bit_input($co2_bit_data, $bit_pos, false);
    $bit_pos++;
    if ($bit_pos === strlen($input_data[0])) {
        break;
    }
}

if (1 === count($oxygen_bit_data) && 1 === count($co2_bit_data)) {
    echo sprintf("%d\n", bindec($oxygen_bit_data[0]) * bindec($co2_bit_data[0]));
}
