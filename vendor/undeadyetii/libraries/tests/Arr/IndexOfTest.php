<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;
use YeTii\General\Num;

/**
 * Class IndexOfTest
 */
class IndexOfTest extends TestCase
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
     * Test whether it returns the key for the specified value
     */
    public function testCanGetIndexOfNeedleInArray()
    {
        $array = new Arr($this->testData);
        $this->assertTrue($array->indexOf('pears') === 1);
    }
}