<?php declare(strict_types=1);

class BingoBoardNumber
{
    private bool $checked = false;

    public function __construct(private int $number) {}

    public function getNumber(): int
    {
        return $this->number;
    }

    public function isChecked(): bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): void
    {
        $this->checked = $checked;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}
