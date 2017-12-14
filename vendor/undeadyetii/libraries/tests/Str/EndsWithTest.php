<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class EndsWithTest
 */
class EndsWithTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it ends with a string using the correct case
     */
    public function testEndsWithCorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->endsWith('Snowball') === true);
    }

    /**
     * Test whether it ends with a string using the incorrect case
     */
    public function testEndsWithIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->endsWith('snowball') === false);
    }

    /**
     * Test whether it ends with a string using the incorrect case with case-insensitive
     */
    public function testEndsWithIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->endsWith('snowball', true) === true);
    }
}