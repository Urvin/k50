<?php


namespace app\library\spreader;

use \InvalidArgumentException;
use \RuntimeException;
use app\library\formatter\Formatter;

class FileSpreader extends Spreader
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var bool|resource
     */
    protected $fileHandler;
    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * FileSpreader constructor.
     * @param int $placesCount
     * @param int $objectsCount
     * @param string $filename
     * @param Formatter|null $formatter
     * @throws InvalidArgumentException
     */
    public function __construct(int $placesCount = 1, int $objectsCount = 1, string $filename = '', ?Formatter $formatter = null)
    {
        $this->setFilename($filename);
        $this->setFormatter($formatter);
        parent::__construct($placesCount, $objectsCount);
    }

    /**
     * @param string $value
     */
    public function setFilename(string $value): void
    {
        $this->filename = $value;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param Formatter|null $formatter
     */
    public function setFormatter(?Formatter $formatter): void
    {
        $this->formatter = $formatter;
    }

    /**
     * @return Formatter|null
     */
    public function getFormatter(): ?Formatter
    {
        return $this->formatter;
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        return parent::validate()
            && !empty($this->filename);
    }

    /**
     * @inheritDoc
     * @throws RuntimeException
     */
    protected function beforeSpread(): void
    {
        $this->fileHandler = @fopen($this->filename, 'w');
        if(!$this->fileHandler) {
            throw new RuntimeException('File is not writable');
        }
    }

    /**
     * @inheritDoc
     */
    protected function afterSpread(): void
    {
        if($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    /**
     * @inheritDoc
     */
    protected function afterCombinationCountCalculated($combinationCount): bool
    {
        if($combinationCount < 10) {
            fwrite($this->fileHandler,'Менее 10 вариантов');
            return false;
        } else {
            fwrite($this->fileHandler,$combinationCount . PHP_EOL);
        }

        return parent::afterCombinationCountCalculated($combinationCount);
    }

    /**
     * @inheritDoc
     */
    protected function onCombination(string $combination): void
    {
        fwrite($this->fileHandler, ($this->formatter ? $this->formatter->format($combination) : $combination) . PHP_EOL);
    }
}