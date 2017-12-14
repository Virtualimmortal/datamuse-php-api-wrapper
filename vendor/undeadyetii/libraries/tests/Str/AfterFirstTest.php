<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class AfterFirstTest
 */
class AfterFirstTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has the correct result after a string using the correct case
     */
    public function testAfterFirstCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterFirst('s');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === ' over the lazy dog, Snowball');
    }

    /**
     * Test whether it has the correct result after a string string using the incorrect case
     */
    public function testAfterFirstCorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterFirst('S');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'nowball');
    }

    /**
     * Test whether it has the correct result after a string using the incorrect case with case-insensitive
     */
    public function testAfterFirstCorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterFirst('S', true);
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === ' over the lazy dog, Snowball');
    }
}