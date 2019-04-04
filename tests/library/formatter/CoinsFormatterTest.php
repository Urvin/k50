<?php

namespace tests\library\formatter;

use app\library\formatter\CoinsFormater;
use PHPUnit\Framework\TestCase;

class CoinsFormatterTest extends TestCase
{
    public function testFormatterOutput(): void
    {
        $formatter = new CoinsFormater();

        $this->assertEquals(
            $formatter->format('101010'),
            '➀‿➀‿➀‿'
        );
    }
}