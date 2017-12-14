<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IsCapitalizedWordsTest
 */
class IsCapitalizedWordsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether all words start with a capital letter
     */
    public function testIsCapitalizedWithCorrectCase()
    {
        $str = new Str(ucwords($this->testString));
        $this->assertTrue($str->isCapitalizedWords());
    }

    /**
     * Test whether all words start with a capital letter
     */
    public function testIsCapitalizedWithIncorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertFalse($str->isCapitalizedWords());
    }
}