<?php


namespace app\library\formatter;


interface Formatter
{
    /**
     * Format combination string
     * @param string $combination
     * @return string
     */
    public function format(string $combination): string;
}