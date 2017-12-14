<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class AcronymTest
 */
class AcronymTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns an acronym for the string
     */
    public function testAcronym()
    {
        $str = new Str($this->testString);
        $result = $str->acronym();
        $this->assertTrue($result->value === 'TqbfjotldS');
    }

    /**
     * Test whether it returns an acronym for the string (output capitalized)
     */
    public function testAcronymWithCapitalizedOutput()
    {
        $str = new Str($this->testString);
        $result = $str->acronym(true);
        $this->assertTrue($result->value === 'TQBFJOTLDS');
    }

    /**
     * Test whether it returns an acronym for the string (lowercase ignored)
     */
    public function testAcronymWithLowercaseIgnored()
    {
        $str = new Str($this->testString);
        $result = $str->acronym(false, true);
        $this->assertTrue($result->value === 'TS');
    }

    /**
     * Test whether it returns an acronym for the string (output capitalized, lowercase ignored)
     */
    public function testAcronymWithCapitalizedOutputAndLowercaseIgnored()
    {
        $str = new Str($this->testString);
        $result = $str->acronym(true, true);
        $this->assertTrue($result->value === 'TS');
    }
}