<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class CharactersTest
 */
class CharactersTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns the correct characters as an array
     */
    public function testCharacters()
    {
        $str = new Str($this->testString);
        $result = $str->characters();
        $this->assertInternalType('array', $result);
        $this->assertTrue($result[0] === 'T');
        $this->assertTrue(count($result) === 53);
    }
}