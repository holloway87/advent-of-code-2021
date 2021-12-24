<?php declare(strict_types=1);

class FileInput
{
    private $fp;

    public function __construct(string $filename)
    {
        $this->fp = fopen($filename, 'r');
    }

    public function __destruct()
    {
        if ($this->fp) {
            fclose($this->fp);
        }
    }

    public function getLine(): ?string
    {
        $input = fgets($this->fp);
        if (!$input) {
            return null;
        }

        return trim($input);
    }

    public function readAllLines(): array
    {
        $lines = [];
        while ($line = $this->getLine()) {
            $lines[] = $line;
        }

        return $lines;
    }
}
