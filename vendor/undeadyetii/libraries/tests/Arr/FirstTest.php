<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class FirstTest
 */
class FirstTest extends TestCase
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
     * Test whether it shifts the first element off the array and returns this
     */
    public function testCanGetFirstArrayElement()
    {
        $array = new Arr($this->testData);
        $result = $array->first();

        $this->assertTrue($result === ['apples']);
        $this->assertTrue($array->toArray() === ['oranges', 'apples']);
    }
}