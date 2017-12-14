<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IsCapitalizedTest
 */
class IsCapitalizedTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it starts with a capital letter
     */
    public function testIsCapitalized()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->isCapitalized());
    }
}