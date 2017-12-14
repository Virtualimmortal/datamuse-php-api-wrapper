<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplaceTest
 */
class ReplaceTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it replaces correctly using a correct case
     */
    public function testReplaceUsingCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replace('Snowball', 'Snuffles');
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }

    /**
     * Test whether it replaces correctly using an incorrect case
     */
    public function testReplaceUsingIncorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replace('snowball', 'Snuffles');
        $this->assertFalse($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }

    /**
     * Test whether it replaces correctly using an incorrect case with ignore
     */
    public function testReplaceUsingIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replace('snowball', 'Snuffles', true);
        $this->assertTrue($str2->value === 'The quick brown fox jumps over the lazy dog, Snuffles');
    }
}