<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class ToRomanNumeralsTest
 */
class ToRomanNumeralsTest extends TestCase
{
    /**
     * @var int
     */
    public $testData = 1234;

    /**
     * Test whether it returns a string of roman numerals response from the provided integer
     */
    public function testToRomanNumerals()
    {
        $result = Num::toRomanNumerals($this->testData);
        $this->assertTrue($result === 'MCCXXXIV');
    }
}