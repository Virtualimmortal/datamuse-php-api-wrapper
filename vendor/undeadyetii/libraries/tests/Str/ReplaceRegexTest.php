<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplaceRegexTest
 */
class ReplaceRegexTest extends TestCase
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
        $str2 = $str->replaceRegex('([A-Z][a-z]+)', 'Word');
        $this->assertTrue($str2->value === 'Word quick brown fox jumps over the lazy dog, Word');
    }

    /**
     * Test whether it replaces correctly using an incorrect case
     */
    public function testReplaceUsingIncorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceRegex('([a-z][a-z]+)', 'Word');
        $this->assertFalse($str2->value === 'Tword word word word word word word word word, Sword');
    }

    /**
     * Test whether it replaces correctly using an incorrect case with ignore
     */
    public function testReplaceUsingIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceRegex('([a-z][a-z]+)', 'word', true);
        $this->assertTrue($str2->value === 'Tword word word word word word word word word, Sword');
    }
}