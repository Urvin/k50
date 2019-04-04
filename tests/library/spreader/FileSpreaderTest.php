<?php


namespace library\spreader;

use app\library\formatter\CoinsFormater;
use app\library\spreader\FileSpreader;
use PHPUnit\Framework\TestCase;
use \RuntimeException;

class FileSpreaderTest extends TestCase
{
    public function testSpreaderGettersSetters(): void
    {
        $spreader = new FileSpreader(10, 5, '/tmp/test.txt');
        $this->assertEquals(
            $spreader->getFilename(),
            '/tmp/test.txt'
        );

        $spreader->setFilename('/tmp/spreader.txt');
        $this->assertEquals(
            $spreader->getFilename(),
            '/tmp/spreader.txt'
        );
    }

    public function testSpreaderValidation(): void
    {
        $spreader = new FileSpreader(10, 5, '/tmp/test.txt');
        $this->assertTrue(
            $spreader->validate()
        );

        $spreader->setFilename('');
        $this->assertTrue(
            !$spreader->validate()
        );
    }

    public function testSpreaderWork(): void
    {
        $expected = 'test_ugly.txt';
        $actual = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . '10x5_ugly.txt';

        $spreader = new FileSpreader(10, 5, $expected);
        $spreader->spread();

        $this->assertFileExists(
            $expected
        );
        $this->assertFileExists(
            $actual
        );
        $this->assertFileEquals(
            $expected,
            $actual
        );

        if(file_exists($expected)) {
            unlink($expected);
        }
    }

    public function testSpreaderWorkFormatted(): void
    {
        $expected = 'test_formatted.txt';
        $actual = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . '10x5_formatted.txt';

        $spreader = new FileSpreader(10, 5, $expected, new CoinsFormater());
        $spreader->spread();

        $this->assertFileExists(
            $expected
        );
        $this->assertFileExists(
            $actual
        );
        $this->assertFileEquals(
            $expected,
            $actual
        );

        if(file_exists($expected)) {
            unlink($expected);
        }
    }

    public function testSpreaderWorkshort(): void
    {
        $expected = 'test_short.txt';
        $actual = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . '4x2_short.txt';

        $spreader = new FileSpreader(4, 2, $expected);
        $spreader->spread();

        $this->assertFileExists(
            $expected
        );
        $this->assertFileExists(
            $actual
        );
        $this->assertFileEquals(
            $expected,
            $actual
        );

        if(file_exists($expected)) {
            unlink($expected);
        }
    }

    public function testSpreaderFileFailure(): void
    {
        $this->expectException(RuntimeException::class);
        $spreader = new FileSpreader(10, 5, '/u/n/b/e/l/i/e/v/a/b/l/e/file.name');
        $spreader->spread();
    }
}