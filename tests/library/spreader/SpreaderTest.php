<?php


namespace tests\library\spreader;

use app\library\spreader\Spreader;
use PHPUnit\Framework\TestCase;

class SpreaderTest extends TestCase
{

    public function testSpreaderGettersSetters(): void
    {
        $spreader = new Spreader(1, 1);

        $spreader->setPlacesCount(800);
        $this->assertEquals(
            $spreader->getPlacesCount(),
            800
        );

        $spreader->setObjectsCount(9987);
        $this->assertEquals(
            $spreader->getObjectsCount(),
            9987
        );
    }

    public function testSpreaderValidation(): void
    {
        $spreader = new Spreader();
        $this->assertTrue(
            $spreader->validate()
        );

        $spreader->setPlacesCount(10);
        $spreader->setObjectsCount(5);
        $this->assertTrue(
            $spreader->validate()
        );

        $spreader->setPlacesCount(14);
        $spreader->setObjectsCount(14);
        $this->assertTrue(
            $spreader->validate()
        );

        $spreader->setPlacesCount(86);
        $spreader->setObjectsCount(119);
        $this->assertTrue(
            !$spreader->validate()
        );
    }

    public function testSpreaderCombinationsCount()
    {
        $spreader = new Spreader();
        $this->assertEquals(
            $spreader->getCombinationsCount(),
            '1'
        );

        $spreader->setPlacesCount(4);
        $spreader->setObjectsCount(2);
        $this->assertEquals(
            $spreader->getCombinationsCount(),
            '6'
        );


        $spreader->setPlacesCount(36);
        $spreader->setObjectsCount(18);
        $this->assertEquals(
            $spreader->getCombinationsCount(),
            '9075135300'
        );
    }

    public function testSpreaderWork()
    {
        $spreader = new Spreader(10, 5);

        $this->assertNull(
            $spreader->spread()
        );

        /*
        //Commit suicide
        $spreader->setPlacesCount(1000);
        $spreader->setObjectsCount(37);
        $this->assertNull(
            $spreader->spread()
        );
        */
    }


}