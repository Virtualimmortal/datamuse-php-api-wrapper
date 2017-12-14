<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class StripExtensionTest
 */
class StripExtensionTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball.txt';

    /**
     * Test whether it returns a string with the extension stripped
     */
    public function testHtml()
    {
        $str = new Str($this->testString);
        $result = $str->stripExtension();
        $this->assertTrue($result->value === 'The quick brown fox jumps over the lazy dog, Snowball');
    }
}