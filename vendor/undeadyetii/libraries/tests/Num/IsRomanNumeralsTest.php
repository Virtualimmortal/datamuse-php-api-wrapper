<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class IsRomanNumeralsTest
 */
class IsRomanNumeralsTest extends TestCase
{
    /**
     * @var string
     */
    public $validTestData = 'MCCXXXIV';
    /**
     * @var string
     */
    public $invalidTestData = 'MCCXBITZ';

    /**
     * Test whether it returns true for a valid input
     */
    public function testIsRomanNumeralsWithValidString()
    {
        $result = Num::isRomanNumerals($this->validTestData);
        $this->assertTrue($result);
    }

    /**
     * Test whether it returns false for an invalid input
     */
    public function testIsRomanNumeralsWithInvalidString()
    {
        $result = Num::isRomanNumerals($this->invalidTestData);
        $this->assertFalse($result);
    }
}