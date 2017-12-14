<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class CapitalizeWordsTest
 */
class CapitalizeWordsTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it will capitalize the words
     */
    public function testCapitalizeWords()
    {
        $str = new Str($this->testString);
        $str2 = $str->capitalizeWords();
        $this->assertTrue($str2->value === ucwords($this->testString));
    }
}