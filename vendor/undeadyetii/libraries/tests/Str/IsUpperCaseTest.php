<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IsUpperCaseTest
 */
class IsUpperCaseTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it works correctly using the correct case
     */
    public function testIsUpperCorrectCase()
    {
        $str = new Str(strtoupper($this->testString));
        $this->assertTrue($str->isUpperCase());
    }

    /**
     * Test whether it works correctly using the incorrect case
     */
    public function testIsUpperIncorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertFalse($str->isUpperCase());
    }
}