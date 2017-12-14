<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class IndexFirstTest
 */
class IndexFirstTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it has a first index using the correct case
     */
    public function testIndexFirstCorrectCase()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexFirst('T') === 0);
    }

    /**
     * Test whether it doesn't have a first index using the incorrect case
     */
    public function testIndexFirstIncorrectCaseWithoutIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexFirst('t') !== 0);
    }

    /**
     * Test whether it has a first index using the incorrect case with case-insensitive
     */
    public function testIndexFirstIncorrectCaseWithIgnore()
    {
        $str = new Str($this->testString);
        $this->assertTrue($str->indexFirst('t', true) === 0);
    }
}