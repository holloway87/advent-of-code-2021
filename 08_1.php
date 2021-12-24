<?php declare(strict_types=1);

require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/08_1.txt');

$counts = [2, 3, 4, 7];
$cnt = 0;
while ($line = $file_input->getLine()) {
    $io = explode(' | ', $line);
    $output = explode(' ', $io[1]);

    foreach ($output as $item) {
        if (in_array(strlen($item), $counts)) {
            $cnt++;
        }
    }
}

echo sprintf("%d\n", $cnt);
