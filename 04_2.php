<?php declare(strict_types=1);

require_once __DIR__.'/BingoBoard.php';
require_once __DIR__.'/FileInput.php';

$file_input = new FileInput(__DIR__.'/input/04_2.txt');

function castArrayInt(array &$array): void {
    foreach ($array as $idx => $value) {
        $array[$idx] = (int)$value;
    }
}

/** @var int[] $bingo_numbers */
$line = $file_input->getLine();
$bingo_numbers = explode(',', $line);
castArrayInt($bingo_numbers);

/** @var BingoBoard[] $bingo_boards */
$bingo_boards = [];

function createBingoBoard(array $data) {
    global $bingo_boards;

    if (5 === count($data)) {
        $bingo_boards[] = new BingoBoard($data);
    }
}

$rows = [];
while (true) {
    $line = $file_input->getLine();
    if (null === $line) {
        break;
    }

    if (!$line) {
        createBingoBoard($rows);
        $rows = [];

        continue;
    }

    if (!preg_match_all('/\d+/', $line, $match) || 5 !== count($match[0])) {
        continue;
    }
    castArrayInt($match[0]);
    $rows[] = $match[0];
}
createBingoBoard($rows);

$last_winning_number = null;
$last_unchecked_sum = null;
foreach ($bingo_numbers as $number) {
    foreach ($bingo_boards as $bingo_board) {
        if ($bingo_board->checkNumber($number)) {
            $last_unchecked_sum = $bingo_board->getUncheckedSum();
            $last_winning_number = $number;
        }
    }
}

echo sprintf("%d\n", $last_winning_number * $last_unchecked_sum);
