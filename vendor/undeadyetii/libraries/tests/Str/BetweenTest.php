<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class BetweenTest
 */
class BetweenTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns between two strings
     */
    public function testBetween()
    {
        $str = new Str($this->testString);
        $str2 = $str->between('e', 'S');
        $this->assertTrue($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it returns between two incorrect strings
     */
    public function testBetweenInvalidStrings()
    {
        $str = new Str($this->testString);
        $str2 = $str->between('e', 's');
        $this->assertFalse($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it returns between two strings with ignore
     */
    public function testBetweenInvalidStringsWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenGreedy('e', 's', true);
        $this->assertTrue($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }
}