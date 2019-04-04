<?php


namespace app\helpers;

use \InvalidArgumentException;


class Math
{
    /**
     * Calculates a factorial of given number.
     * @param int $value
     * @return string
     * @throws InvalidArgumentException
     */
    public static function factorial(int $value): string
    {
        if (!filter_var($value, FILTER_VALIDATE_INT) || $value <= 0) {
            throw new InvalidArgumentException('Argument should be a natural number');
        }

        for ($result = '1'; $value > 0; $value--) {
            $result = bcmul($result, $value);
        }

        return $result;
    }


    /**
     * Calculates combinations count of $k objects in $n places.
     * via https://www.matburo.ru/tvart_sub.php?p=calc_C
     * @param int $n
     * @param int $k
     * @return string|null
     * @throws InvalidArgumentException
     */
    public static function combinationsCount(int $n, int $k): ?string
    {
        if($k > $n) {
            throw new InvalidArgumentException('$k argument should not be greater than $n');
        }

        if($k == $n) {
            return '1';
        }

        return bcdiv(
            self::factorial($n),
            bcmul(self::factorial($n - $k), self::factorial($k))
        );
    }
}