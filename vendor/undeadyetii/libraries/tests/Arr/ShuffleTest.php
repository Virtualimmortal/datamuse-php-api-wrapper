<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class ShuffleTest
 */
class ShuffleTest extends TestCase
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
     * Test whether it returns a shuffled array
     */
    public function testCanShuffleTheArray()
    {
        $array = new Arr($this->testData);
        $result = $array->shuffle();
        $this->assertInstanceOf(Arr::class, $result);
        $this->assertInternalType('array', $result->toArray());
        $this->assertFalse($result === $this->testData);
    }
}