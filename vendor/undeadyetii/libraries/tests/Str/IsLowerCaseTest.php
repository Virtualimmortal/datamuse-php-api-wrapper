<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IsLowerCaseTest
 */
class IsLowerCaseTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it works correctly using the correct case
     */
    public function testIsLowerCorrectCase()
    {
        $str = new Str(strtolower($this->testString));
        $this->assertTrue($str->isLowerCase());
    }

    /**
     * Test whether it works correctly using the incorrect case
     */
    public function testIsLowerIncorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertFalse($str->isLowerCase());
    }
}