<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class IndexesOfTest
 */
class IndexesOfTest extends TestCase
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
     * Test whether it returns the keys for the specified value
     */
    public function testCanGetIndexesOfNeedleInArray()
    {
        $array = new Arr($this->testData);
        $this->assertTrue($array->indexesOf('apples') === [0, 2]);
    }
}