<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class BetweenLazyTest
 */
class BetweenLazyTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns lazily between two strings
     */
    public function testBetweenLazy()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenLazy('e', 'S');
        $this->assertTrue($str2->value === ' lazy dog, ');
    }

    /**
     * Test whether it returns lazily between two incorrect strings
     */
    public function testBetweenLazyInvalidStrings()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenLazy('e', 's');
        $this->assertFalse($str2->value === ' lazy dog, ');
    }

    /**
     * Test whether it returns lazily between two strings with ignore
     */
    public function testBetweenLazyInvalidStringsWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenLazy('e', 's', true);
        $this->assertTrue($str2->value === ' lazy dog, ');
    }
}