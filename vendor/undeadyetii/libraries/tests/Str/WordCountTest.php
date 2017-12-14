<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class WordCountTest
 */
class WordCountTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns the correct word count
     */
    public function testWordCount()
    {
        $str = new Str($this->testString);
        $result = $str->wordCount();
        $this->assertInternalType('int', $result);
        $this->assertTrue($result === 10);
    }

    /**
     * Test whether it returns the correct word count while ignoring empty keys
     */
    public function testWordCountIgnoreEmpty()
    {
        $str = new Str($this->testString);
        $result = $str->wordCount(null, true);
        $this->assertInternalType('int', $result);
        $this->assertTrue($result === 10);
    }
}