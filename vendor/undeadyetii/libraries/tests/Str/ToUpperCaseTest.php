<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ToUpperCaseTest
 */
class ToUpperCaseTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns an upper case string
     */
    public function testToUpperCase()
    {
        $str = new Str($this->testString);
        $str2 = $str->toUpperCase();
        $this->assertTrue($str2->value === strtoupper($this->testString));
    }
}