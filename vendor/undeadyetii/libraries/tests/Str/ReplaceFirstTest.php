<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplaceFirstTest
 */
class ReplaceFirstTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it replaces the first instance correctly using a correct case
     */
    public function testReplaceFirstCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceFirst('The', 'A');
        $this->assertTrue($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }

    /**
     * Test whether it replaces the first instance correctly using an incorrect case
     */
    public function testReplaceFirstIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceFirst('the', 'A');
        $this->assertFalse($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }

    /**
     * Test whether it replaces the first instance correctly using an incorrect case with ignore
     */
    public function testReplaceFirstIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceFirst('the', 'A', true);
        $this->assertTrue($str2->value === 'A quick brown fox jumps over the lazy dog, Snowball');
    }
}