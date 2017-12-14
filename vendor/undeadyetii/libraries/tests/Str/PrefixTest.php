<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class PrefixTest
 */
class PrefixTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it prefixes correctly
     */
    public function testPrefix()
    {
        $str = new Str($this->testString);
        $str2 = $str->prefix('the ');
        $this->assertTrue($str2->value === 'the ' . $this->testString);
    }

    /**
     * Test whether it prefixes with existing
     */
    public function testPrefixIfNotExists()
    {
        $str = new Str($this->testString);
        $str2 = $str->prefix('the ', true);
        $this->assertTrue($str2->value === 'the ' . $this->testString);
    }

    /**
     * Test whether it prefixes while not ignoring existing
     */
    public function testPrefixIfNotExistsWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->prefix('the ', false, true);
        $this->assertTrue($str2->value === 'the ' . $this->testString);
    }

    /**
     * Test whether it prefixes while ignoring existing
     */
    public function testPrefixIfNotExistsWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->prefix('the ', true, true);
        $this->assertFalse($str2->value === 'the ' . $this->testString);
    }
}