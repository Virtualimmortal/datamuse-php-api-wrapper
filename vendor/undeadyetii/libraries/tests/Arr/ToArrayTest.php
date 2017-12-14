<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;
use YeTii\General\Num;

/**
 * Class ToArrayTest
 */
class ToArrayTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'apples',
        'pears',
        'oranges'
    ];

    /**
     * Test whether it returns the data as an array instance
     */
    public function testCanConvertArrToArray()
    {
        $result = new Arr($this->testData);
        $this->assertTrue($result->toArray() === $this->testData);
    }
}