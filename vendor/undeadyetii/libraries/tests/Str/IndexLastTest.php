<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IndexLastTest
 */
class IndexLastTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has a last index using the correct case
     */
    public function testIndexLastCorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexLast('t') === 31);
    }

    /**
     * Test whether it doesn't have a last index using the incorrect case
     */
    public function testIndexLastIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexLast('T') !== 31);
    }

    /**
     * Test whether it has a last index using the incorrect case with case-insensitive
     */
    public function testIndexLastIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexLast('T', true) === 31);
    }
}