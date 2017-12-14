<?php

namespace Yetii\Tests\Num;

use PHPUnit\Framework\TestCase;
use YeTii\General\Num;

/**
 * Class CustomEquationTest
 */
class CustomEquationTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        'modifier' => '√',
        'arg'     => 4
    ];

    /**
     * Test whether it returns the result of a custom equation
     */
    public function testSquareRoot()
    {
        $result = Num::customEquation(null, $this->testData['modifier'], $this->testData['arg']);
        $this->assertTrue($result === (double)2);
    }
}