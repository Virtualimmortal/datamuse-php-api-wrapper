<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class StartsWithTest
 */
class StartsWithTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it starts with a string using the correct case
     */
    public function testStartsWithCorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->startsWith('The') === true);
    }

    /**
     * Test whether it starts with a string using the incorrect case
     */
    public function testStartsWithIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->startsWith('the') === false);
    }

    /**
     * Test whether it starts with a string using the incorrect case with case-insensitive
     */
    public function testStartsWithIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->startsWith('the', true) === true);
    }
}