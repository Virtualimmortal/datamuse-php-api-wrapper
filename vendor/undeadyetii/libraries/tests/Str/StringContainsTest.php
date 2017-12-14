<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class StringContainsTest
 */
class StringContainsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it matches using the correct case
     */
    public function testContainsCorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->contains('fox'));
    }

    /**
     * Test whether it doesn't match using the incorrect case
     */
    public function testContainsIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $this->assertFalse($str->contains('FOX'));
    }

    /**
     * Test whether it detects using the incorrect case with case-insensitive
     */
    public function testContainsIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->contains('FOX', true));
    }
}