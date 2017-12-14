<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class AtTest
 */
class AtTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'right'       => 'apples',
        'wrong'       => 'oranges',
        'wrongAsWell' => 'apples',
    ];

    /**
     * Test whether it returns the value for the specified key
     */
    public function testCanGetValueAtSpecifiedKey()
    {
        $array = new Arr($this->testData);
        $this->assertTrue($array->at('right') === 'apples');
        $this->assertFalse($array->at('wrong') === 'apples');
    }
}