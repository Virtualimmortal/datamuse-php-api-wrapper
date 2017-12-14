<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class PrependTest
 */
class PrependTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'bananas'
    ];

    /**
     * Test whether it prepends the specified value to the array
     */
    public function testCanPrependValueToArray()
    {
        $array = new Arr($this->testData);
        $array->prepend('pears');

        $this->assertArrayHasKey(0, $array->toArray());
        $this->assertTrue($array->toArray()[0] === 'pears');
    }
}