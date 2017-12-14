<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class LastTest
 */
class LastTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'apples',
        'bananas',
        'apples',
        'oranges',
    ];

    /**
     * Test whether it pops the last element off the array and returns this
     */
    public function testCanGetLastArrayElement()
    {
        $array = new Arr($this->testData);
        $result = $array->last();

        $this->assertTrue($result === ['oranges']);
        $this->assertTrue($array->toArray() === ['apples', 'bananas', 'apples']);
    }
}