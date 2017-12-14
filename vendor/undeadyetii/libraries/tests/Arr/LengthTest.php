<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class LengthTest
 */
class LengthTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'apples',
        'oranges',
        'apples',
    ];

    /**
     * Test whether it returns the length of the array
     */
    public function testCanGetLengthOfArray()
    {
        $array = new Arr($this->testData);
        $this->assertTrue($array->length() === 3);
    }
}