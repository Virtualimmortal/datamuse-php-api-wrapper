<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns a lower-case, dash-delimited string for use in a slug
     */
    public function testUrl()
    {
        $str = new Str($this->testString);
        $result = $str->url();
        $this->assertTrue($result->value === 'the-quick-brown-fox-jumps-over-the-lazy-dog-snowball');
    }
}