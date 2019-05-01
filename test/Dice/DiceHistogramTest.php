<?php

namespace Aisa\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHistogram.
 */

class DiceHistogram2 extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArgumentsMax()
    {
        $dice = new \Aisa\Dice\DiceHistogram();
        $this->assertInstanceOf("\Aisa\Dice\DiceHistogram", $dice);

        $res = $dice->getHistogramMax();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArgumentsMin()
    {
        $dice = new \Aisa\Dice\DiceHistogram();
        $this->assertInstanceOf("\Aisa\Dice\DiceHistogram", $dice);

        $res = $dice->getHistogramMin();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }
}
