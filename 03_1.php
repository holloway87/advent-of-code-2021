<?php declare(strict_types=1);

$file_input = fopen(__DIR__.'/input/03_1.txt', 'r');

$epsilon_rate = [];
$gamma_rate = [];
$cnt = 0;
while ($input = fgets($file_input)) {
    $input = trim($input);
    if (!$input || !preg_match('/^[01]+$/', $input)) {
        continue;
    }

    for ($c = 0; $c < strlen($input); $c++) {
        if (!array_key_exists($c, $epsilon_rate)) {
            $epsilon_rate[$c] = 0;
        }
        if (!array_key_exists($c, $gamma_rate)) {
            $gamma_rate[$c] = 0;
        }
        $value = (int)$input[$c];
        if (0 === $value) {
            $epsilon_rate[$c]++;
        }
        if (1 === $value) {
            $gamma_rate[$c]++;
        }
    }
    $cnt++;
}

fclose($file_input);

function calc_binary(array $data): string {
    global $cnt;

    $binary = '';
    for ($c = 0; $c < count($data); $c++) {
        $binary .= $data[$c] >= ($cnt / 2) ? '1' : '0';
    }

    return $binary;
}

$epsilon_rate = calc_binary($epsilon_rate);
$gamma_rate = calc_binary($gamma_rate);

echo sprintf("%d\n", bindec($epsilon_rate) * bindec($gamma_rate));
