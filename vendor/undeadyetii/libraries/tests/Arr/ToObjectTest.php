<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;
use YeTii\General\Num;

/**
 * Class ToObjectTest
 */
class ToObjectTest extends TestCase
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
     * Test whether it returns the data as an object instance
     */
    public function testCanConvertArrToObject()
    {
        $array = new Arr($this->testData);
        $result = $array->toObject();

        $this->assertInstanceOf(\stdClass::class, $result);
        $this->assertTrue($result == (object)$this->testData);
    }
}