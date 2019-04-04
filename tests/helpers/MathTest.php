<?php
namespace tests\helpers;

use app\helpers\Math;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    public function testFactorialWithValidParameter(): void
    {
        $this->assertEquals(
            Math::factorial(1),
            '1'
        );
        $this->assertEquals(
            Math::factorial(5),
            '120'
        );
        $this->assertEquals(
            Math::factorial(100),
            '93326215443944152681699238856266700490715968264381621468592963895217599993229915608941463976156518286253697920827223758251185210916864000000000000000000000000'
        );
    }

    public function testFactorialWithNullParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $result = Math::factorial(0);
    }

    public function testFactorialWithInvalidParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $result = Math::factorial(-100);
    }

    public function testCombinationsCountWithValidParameter(): void
    {
        $this->assertEquals(
            Math::combinationsCount(1, 1),
            1
        );
        $this->assertEquals(
            Math::combinationsCount(4, 2),
            6
        );
        $this->assertEquals(
            Math::combinationsCount(36, 18),
            '9075135300'
        );
    }

    public function testCombinationsCountWithInvalidParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $result = Math::combinationsCount(1, 18);
    }
}