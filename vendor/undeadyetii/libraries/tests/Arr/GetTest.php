<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class GetTest
 */
class GetTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'bananas' => [
            'oranges' => [
                'apples' => 'pears'
            ]
        ]
    ];

    /**
     * Test whether it returns the value for the specified key
     */
    public function testCanGetValueAtSpecifiedKey()
    {
        $array = new Arr($this->testData);
        $this->assertArrayHasKey('apples', $array->get('bananas.oranges'));
        $this->assertTrue($array->get('bananas.oranges.apples') === 'pears');
    }
}