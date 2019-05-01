<?php

namespace Aisa\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class HistogramTraitTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $histogram = new DiceHistogram();
        $this->assertInstanceOf("\Aisa\Dice\DiceHistogram", $histogram);

        $res = $histogram->printHistogram(1, 6);
        $exp = '<li>';
        $this->assertContains($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArgumentsSerie()
    {
        $histogram = new \Aisa\Dice\DiceHistogram();
        $this->assertInstanceOf("\Aisa\Dice\DiceHistogram", $histogram);
        $res = $histogram->getHistogramSerie();
        $exp = [];
        $this->assertEquals($exp, $res);
    }
}
