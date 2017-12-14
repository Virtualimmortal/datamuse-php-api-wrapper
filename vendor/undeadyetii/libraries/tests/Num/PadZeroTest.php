<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class PadZeroTest
 */
class PadZeroTest extends TestCase
{
    /**
     * @var int
     */
    public $testData = 1234;

    /**
     * Test whether it returns the result as a string that has been padded
     */
    public function testPadZeroWithIntegerToString()
    {
        $result = Num::padZero($this->testData, 6);
        $this->assertTrue($result === '001234');
    }
}