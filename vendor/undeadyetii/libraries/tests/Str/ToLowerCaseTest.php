<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ToLowerCaseTest
 */
class ToLowerCaseTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns a lower case string
     */
    public function testToLowerCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->toLowerCase();
        $this->assertTrue($str2->value === strtolower($this->testString));
    }
}