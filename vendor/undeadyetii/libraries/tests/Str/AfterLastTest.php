<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class AfterLastTest
 */
class AfterLastTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has the correct result after a string using the correct case
     */
    public function testAfterLastCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterLast('S');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'nowball');
    }

    /**
     * Test whether it has the correct result after a string string using the incorrect case
     */
    public function testAfterLastIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterLast('s');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value !== 'nowball');
    }

    /**
     * Test whether it has the correct result after a string using the incorrect case with case-insensitive
     */
    public function testAfterLastIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->afterLast('s', true);
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'nowball');
    }
}