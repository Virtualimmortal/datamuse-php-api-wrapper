<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class BeforeLastTest
 */
class BeforeLastTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has the correct result before a string using the correct case
     */
    public function testBeforeLastCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeLast('S');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it has the correct result before a string string using the incorrect case
     */
    public function testBeforeLastIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeLast('s');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value !== 'The quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it has the correct result before a string using the incorrect case with case-insensitive
     */
    public function testBeforeLastIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeLast('s', true);
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, ');
    }
}