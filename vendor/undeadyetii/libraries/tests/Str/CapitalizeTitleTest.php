<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class CapitalizeTitleTest
 */
class CapitalizeTitleTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it will capitalize as a title
     */
    public function testCapitalizeTitle()
    {
        $str = new Str($this->testString);
        $str2 = $str->capitalizeTitle();
        $this->assertTrue($str2->value === 'The Quick Brown Fox Jumps Over the Lazy Dog, Snowball');
    }

    /**
     * Test whether it will capitalize as a title while forcing lowercase first
     */
    public function testCapitalizeTitleAndForceLowerCaseOther()
    {
        $str = new Str(strtoupper($this->testString));
        $str2 = $str->capitalizeTitle(true);
        $this->assertTrue($str2->value === 'The Quick Brown Fox Jumps Over the Lazy Dog, Snowball');
    }
}