<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class SuffixTest
 */
class SuffixTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it suffixes correctly
     */
    public function testSuffix()
    {
        $str = new Str($this->testString);
        $str2 = $str->suffix(', snowball');
        $this->assertTrue($str2->value === $this->testString . ', snowball');
    }

    /**
     * Test whether it suffixes with existing
     */
    public function testSuffixIfNotExists()
    {
        $str = new Str($this->testString);
        $str2 = $str->suffix(', snowball', true);
        $this->assertTrue($str2->value === $this->testString . ', snowball');
    }

    /**
     * Test whether it suffixes while not ignoring existing
     */
    public function testSuffixIfNotExistsWithoutIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->suffix(', snowball', false, true);
        $this->assertTrue($str2->value === $this->testString . ', snowball');
    }

    /**
     * Test whether it suffixes while ignoring existing
     */
    public function testSuffixIfNotExistsWithIgnore()
    {
        $str = new Str($this->testString);
        $str2 = $str->suffix(', snowball', true, true);
        $this->assertFalse($str2->value === $this->testString . ', snowball');
    }
}