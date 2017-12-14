<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplacePrefixTest
 */
class ReplacePrefixTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it replaces correctly using a correct case
     */
    public function testReplacePrefixUsingCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replacePrefix('The', 'A');
        $this->assertTrue($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }

    /**
     * Test whether it replaces correctly using an incorrect case
     */
    public function testReplacePrefixUsingIncorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replacePrefix('the', 'A');
        $this->assertFalse($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }

    /**
     * Test whether it replaces correctly using an incorrect case with ignore
     */
    public function testReplacePrefixUsingIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replacePrefix('the', 'A', true);
        $this->assertTrue($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }
}