<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class NewLineTest
 */
class NewLineTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog,' . "\r" . 'Snowball';

    /**
     * Test whether it returns a string with new lines converted
     */
    public function testNewLine()
    {
        $str = new Str($this->testString);
        $result = $str->newline();
        $this->assertTrue($result->value === 'The quick brown fox jumps over the lazy dog,
Snowball');
    }
}