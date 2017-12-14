<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class RomanNumeralsToIntTest
 */
class RomanNumeralsToIntTest extends TestCase
{
    /**
     * @var string
     */
    public $testData = 'MCCXXXIV';

    /**
     * Test whether it returns an integer from the provided roman numerals
     */
    public function testRomanNumeralsToInt()
    {
        $result = Num::romanNumeralsToInt($this->testData);
        $this->assertTrue($result === 1234);
    }
}