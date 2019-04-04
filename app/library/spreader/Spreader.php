<?php


namespace app\library\spreader;

use app\helpers\Math;
use \InvalidArgumentException;


class Spreader
{
    /**
     * @var int
     */
    protected $placesCount;
    /**
     * @var int
     */
    protected $objectsCount;


    /**
     * Spreader constructor.
     * @param int $placesCount
     * @param int $objectsCount
     * @throws InvalidArgumentException
     */
    public function __construct(int $placesCount = 1, int $objectsCount = 1)
    {
        $this->setPlacesCount($placesCount);
        $this->setObjectsCount($objectsCount);
        if(!$this->validate()) {
            throw new InvalidArgumentException("Wrong arguments given");
        }
    }

    /**
     * @return int
     */
    public function getPlacesCount(): int
    {
        return $this->placesCount;
    }

    /**
     * @param int $value
     */
    public function setPlacesCount(int $value): void
    {
        $this->placesCount = $value;
    }

    /**
     * @return int
     */
    public function getObjectsCount(): int
    {
        return $this->objectsCount;
    }

    /**
     * @param int $value
     */
    public function setObjectsCount(int $value): void
    {
        $this->objectsCount = $value;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return $this->placesCount > 0
            && $this->objectsCount > 0
            && $this->placesCount >= $this->objectsCount;
    }

    /**
     * @return string|null
     * @throws InvalidArgumentException
     */
    public function getCombinationsCount(): ?string
    {
        return Math::combinationsCount($this->placesCount, $this->objectsCount);
    }

    /**
     * Run spread
     */
    public function spread() : void
    {
        if(!$this->validate()) {
            throw new InvalidArgumentException("Wrong arguments given");
        }

        $this->beforeSpread();

        $combinationCount = $this->getCombinationsCount();

        if($this->afterCombinationCountCalculated($combinationCount)) {
            $this->searchPlaces(0, 0);
        }

        $this->afterSpread();
    }

    /**
     * @param int $position
     * @param int $offset
     */
    protected function searchPlaces(int $position, int $offset): void
    {
        static $places = [];
        if($position == $this->objectsCount) {
            $this->onCombination($this->placesToCombination($places));
        } else {
            for ($i = $offset; $i < $this->placesCount; ++$i) {
                $places[$position] = $i;
                $this->searchPlaces($position + 1, $i + 1);
            }
        }
    }

    /**
     * Decodes places map into combination string
     * @param array $places
     * @return string
     */
    protected function placesToCombination(array $places): string
    {
        $result = str_repeat('0', $this->placesCount);
        foreach ($places as $place) {
            $result[$place] = '1';
        }
        return $result;
    }

    /**
     * Called before spreading started
     */
    protected function beforeSpread(): void
    {

    }

    /**
     * Called after spreading finished
     */
    protected function afterSpread(): void
    {

    }

    /**
     * Called after combination count calculated
     * @param $combinationCount
     * @return bool
     */
    protected function afterCombinationCountCalculated($combinationCount): bool
    {
        return true;
    }

    /**
     * Called on new combination found
     * @param string $combination
     */
    protected function onCombination(string $combination): void
    {

    }
}