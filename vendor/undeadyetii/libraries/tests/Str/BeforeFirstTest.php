<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class BeforeFirstTest
 */
class BeforeFirstTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has the correct result before a string using the correct case
     */
    public function testBeforeFirstCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeFirst('s');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'The quick brown fox jump');
    }

    /**
     * Test whether it has the correct result before a string string using the incorrect case
     */
    public function testBeforeFirstIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeFirst('S');
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value !== 'The quick brown fox jump');
    }

    /**
     * Test whether it has the correct result before a string using the incorrect case with case-insensitive
     */
    public function testBeforeFirstIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->beforeFirst('S', true);
        $this->assertInstanceOf(Str::class, $str2);
        $this->assertTrue($str2->value === 'The quick brown fox jump');
    }
}