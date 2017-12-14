<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class WordsTest
 */
class WordsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns an array of the words
     */
    public function testWords()
    {
        $str = new Str($this->testString);
        $result = $str->words();
        $this->assertTrue(is_array($result));
        $this->assertTrue($result[0] === 'The');
    }

    /**
     * Test whether it returns an array of the words, split by letter
     */
    public function testWordsSplitByLetter()
    {
        $str = new Str($this->testString);
        $result = $str->words('/o/');
        $this->assertTrue(is_array($result));
        $this->assertTrue($result[0] === 'The quick br');
    }

    /**
     * Test whether it returns an array of the words, ignoring empty
     */
    public function testWordsSplitByNullWithIgnore()
    {
        $str = new Str($this->testString);
        $result = $str->words(null, true);
        $this->assertTrue(is_array($result));
        $this->assertTrue($result[0] === 'The');
    }

    /**
     * Test whether it returns an array of the words, split by letter and ignoring empty
     */
    public function testWordsSplitByLetterWithIgnore()
    {
        $str = new Str($this->testString);
        $result = $str->words('/o/', true);
        $this->assertTrue(is_array($result));
        $this->assertTrue($result[0] === 'The quick br');
        $this->assertTrue($result[5] === 'wball');
    }
}