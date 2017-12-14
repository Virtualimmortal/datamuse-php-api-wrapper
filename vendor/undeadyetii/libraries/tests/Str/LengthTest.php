<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class LengthTest
 */
class LengthTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns the correct string length
     */
    public function testLength()
    {
        $str = new Str($this->testString);
        $result = $str->length();
        $this->assertInternalType('int', $result);
        $this->assertTrue($result === 53);
    }
}