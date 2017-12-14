<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReplaceLastTest
 */
class ReplaceLastTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it replaces the last instance correctly using a correct case
     */
    public function testReplaceFirstCorrectCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceLast('the', 'a');
        $this->assertTrue($str2->value === 'The quick brown fox jumps over a lazy dog, Snowball');
    }

    /**
     * Test whether it replaces the last instance correctly using an incorrect case
     */
    public function testReplaceFirstIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceLast('The', 'a');
        $this->assertFalse($str2->value === 'The quick brown fox jumps over a lazy dog, Snowball');
    }

    /**
     * Test whether it replaces the last instance correctly using an incorrect case with ignore
     */
    public function testReplaceFirstIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->replaceLast('The', 'a', true);
        $this->assertTrue($str2->value === 'The quick brown fox jumps over a lazy dog, Snowball');
    }
}