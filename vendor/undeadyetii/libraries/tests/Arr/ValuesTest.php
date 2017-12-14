<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class ValuesTest
 */
class ValuesTest extends TestCase
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
     * Test whether it returns an array of the values
     */
    public function testCanGetValuesForArray()
    {
        $array = new Arr($this->testData);
        $result = $array->values();
        $this->assertTrue($result === $this->testData);
    }
}