<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class AppendTest
 */
class AppendTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'bananas'
    ];

    /**
     * Test whether it appends the specified value to the array
     */
    public function testCanAppendValueToArray()
    {
        $array = new Arr($this->testData);
        $array->append('pears');

        $this->assertArrayHasKey(1, $array->toArray());
        $this->assertTrue($array->toArray()[1] === 'pears');
    }
}