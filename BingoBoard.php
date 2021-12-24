<?php declare(strict_types=1);

require_once __DIR__.'/BingoBoardNumber.php';

class BingoBoard
{
    /** @var BingoBoardNumber[][] */
    private array $grid = [];

    private int $grid_size;

    private bool $won_already = false;

    public function __construct(array $data)
    {
        foreach ($data as $row) {
            $cols = [];
            foreach ($row as $col) {
                $cols[] = new BingoBoardNumber($col);
            }
            $this->grid[] = $cols;
        }
        $this->grid_size = count($this->grid);
    }

    public function checkNumber(int $number): bool
    {
        $cols_checked = array_fill(0, $this->grid_size, 0);
        foreach ($this->grid as $cols) {
            $row_checked = 0;
            foreach ($cols as $x => $bingo_number) {
                if ($bingo_number->getNumber() === $number) {
                    $bingo_number->setChecked(true);
                }
                if ($bingo_number->isChecked()) {
                    $row_checked++;
                    $cols_checked[$x]++;
                }
            }
            if ($row_checked === $this->grid_size && !$this->won_already) {
                $this->won_already = true;

                return true;
            }
        }
        foreach ($cols_checked as $col_checked) {
            if ($col_checked === $this->grid_size && !$this->won_already) {
                $this->won_already = true;

                return true;
            }
        }

        return false;
    }

    public function getUncheckedSum(): int
    {
        $sum = 0;
        foreach ($this->grid as $cols) {
            foreach ($cols as $bingo_number) {
                if (!$bingo_number->isChecked()) {
                    $sum += $bingo_number->getNumber();
                }
            }
        }

        return $sum;
    }
}
