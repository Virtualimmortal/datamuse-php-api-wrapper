<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class EqualsTest
 */
class EqualsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it is equal
     */
    public function testEquals()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->equals($this->testString, true));
    }

    /**
     * Test whether it is equal with an invalid string
     */
    public function testEqualsInvalidString()
    {
        $str = new Str($this->testString);
        $this->assertFalse($str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL'));
    }

    /**
     * Test whether it is equal with an invalid string and ignore
     */
    public function testEqualsInvalidStringWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL', true));
    }
}