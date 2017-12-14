<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IsRomanNumeralsTest
 */
class IsRomanNumeralsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether they are valid roman numerals
     */
    public function testValidRomanNumerals()
    {
        $str = new Str('XIV');
        $this->assertTrue($str->isRomanNumerals());
    }
    /**
     * Test whether they are invalid roman numerals
     */
    public function testInvalidRomanNumerals()
    {
        $str = new Str('INVALID');
        $this->assertFalse($str->isRomanNumerals());
    }
}