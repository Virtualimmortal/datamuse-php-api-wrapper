<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplaceSuffixTest
 */
class ReplaceSuffixTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it replaces correctly using a correct case
     */
    public function testReplaceSuffixUsingCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceSuffix('Snowball', 'Snuffles');
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }

    /**
     * Test whether it replaces correctly using an incorrect case
     */
    public function testReplaceSuffixUsingIncorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceSuffix('snowball', 'Snuffles');
        $this->assertFalse($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }

    /**
     * Test whether it replaces correctly using an incorrect case with ignore
     */
    public function testReplaceSuffixUsingIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceSuffix('snowball', 'Snuffles', true);
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }
}