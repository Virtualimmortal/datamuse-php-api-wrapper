<?php

namespace Yetii\Tests\Arr;

use PHPUnit\Framework\TestCase;
use YeTii\General\Arr;

/**
 * Class KeysTest
 */
class KeysTest extends TestCase
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
     * Test whether it returns an array of the keys
     */
    public function testCanGetKeysForArray()
    {
        $array = new Arr($this->testData);
        $result = $array->keys();
        $this->assertTrue($result === [0, 1, 2]);
    }
}