<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class ReadMathTest
 */
class ReadMathTest extends TestCase
{
    /**
     * @var string
     */
    public $testData = '2 + 3';

    /**
     * Test whether it returns the result of a custom equation
     */
    public function testReadMathWithValidInput()
    {
        $result = Num::readMath($this->testData);
        $this->assertTrue($result === 5);
    }

    /**
     * Test whether it returns false for an invalid custom equation
     */
    public function testReadMathWithInvalidInput()
    {
        $result = Num::readMath($this->testData . '<<>)(');
        $this->assertFalse($result);
    }
}