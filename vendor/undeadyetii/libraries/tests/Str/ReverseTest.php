<?php

namespace Yetii\Tests\Str;

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class ReverseTest
 */
class ReverseTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, Snowball';

    /**
     * Test whether it returns a reversed string
     */
    public function testStringReverse()
    {
        $str = new Str($this->testString);
        $result = $str->reverse();
        $this->assertTrue($result->value === 'llabwonS ,god yzal eht revo spmuj xof nworb kciuq ehT');
    }
}