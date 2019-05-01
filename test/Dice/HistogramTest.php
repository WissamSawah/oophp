<?php

namespace Aisa\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Aisa\Dice\Histogram", $histogram);

        $serie = [1, 2, 3];

        $res = $histogram->getAsText($serie);
        $exp = '*';
        $this->assertContains($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArgumentsMin()
    {
        $histogram = new \Aisa\Dice\Histogram();
        $this->assertInstanceOf("\Aisa\Dice\Histogram", $histogram);
        $dice = new \Aisa\Dice\DiceHistogram();
        $histogram->injectData($dice);
        $res = $histogram->min;
        $exp = 1;
        $this->assertEquals($exp, $res);
    }
}
