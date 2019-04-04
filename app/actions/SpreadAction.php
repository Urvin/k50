<?php


namespace app\actions;


use app\library\formatter\CoinsFormater;
use app\library\spreader\FileSpreader;

class SpreadAction
{
    /**
     * @param int $placesCount
     * @param int $objectsCount
     * @param string $filename
     */
    public function run(int $placesCount, int $objectsCount, string $filename)
    {
        $spreader = new FileSpreader($placesCount, $objectsCount, $filename, new CoinsFormater());
        $spreader->spread();
    }
}