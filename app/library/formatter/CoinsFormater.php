<?php


namespace app\library\formatter;


class CoinsFormater implements Formatter
{
    /**
     * @inheritDoc
     */
    public function format(string $combination): string
    {
        return str_replace(['0', '1'], ['‿', '➀'], $combination);
    }
}