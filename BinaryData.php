<?php declare(strict_types=1);

class BinaryData
{
    public static function calcBitData(array $input, int $bit_pos, bool $most_common): string
    {
        $data_cnt = 0;
        foreach ($input as $value) {
            if (!is_string($value)) {
                continue;
            }

            if ('1' === $value[$bit_pos]) {
                $data_cnt++;
            }
        }

        $is_most_common = $data_cnt >= (count($input) / 2);

        if ($most_common) {
            return $is_most_common ? '1' : '0';
        }

        return $is_most_common ? '0' : '1';
    }
}
