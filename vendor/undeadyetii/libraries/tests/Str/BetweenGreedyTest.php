<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class BetweenGreedyTest
 */
class BetweenGreedyTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns greedily between two strings
     */
    public function testBetweenGreedy()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenGreedy('e', 'S');
        $this->assertTrue($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it returns greedily between two incorrect strings
     */
    public function testBetweenGreedyInvalidStrings()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenGreedy('e', 's');
        $this->assertFalse($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }

    /**
     * Test whether it returns greedily between two strings with ignore
     */
    public function testBetweenGreedyInvalidStringsWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->betweenGreedy('e', 's', true);
        $this->assertTrue($str2->value === ' quick brown fox jumps over the lazy dog, ');
    }
}