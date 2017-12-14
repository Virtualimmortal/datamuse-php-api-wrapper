<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class FirstTest
 */
class FirstTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns the correct string for the specified characters
     */
    public function testFirstEquals()
    {
        $str = new Str($this->testString);
        $str2 = $str->first(7);
        $this->assertTrue($str2->value === 'The qui');
    }
}