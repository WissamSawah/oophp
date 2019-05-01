<?php

namespace Aisa\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class GuessCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */

    public function testCreateObjectNoArgument()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Aisa\Dice\Dice", $dice);
        $dice->rollPlayer1();
        $res = count($dice->getDices(0));
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $dice = new Dice(10);
        $this->assertInstanceOf("\Aisa\Dice\Dice", $dice);
        $dice->rollPlayer1();
        $res = count($dice->getDices(0));
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments.
     */
    public function testCreateObjectBothArguments()
    {
        $dice = new Dice(10, 25);
        $this->assertInstanceOf("\Aisa\Dice\Dice", $dice);
        $dice->rollPlayer2();
        $res = count($dice->getDices(1));
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments. And check correct answer
     */
    public function testCreateObjectBothArgumentsDisabledPlayerOne()
    {
        $dice = new Dice(10, 25);
        $this->assertInstanceOf("\Aisa\Dice\Dice", $dice);
        $dice->unavailable(1);
        $res = $dice->getSum(1);
        $exp = "disabled";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments. And check correct answer
     */
    public function testCreateObjectBothArgumentsDisabledPlayerTwo()
    {
        $dice = new Dice(10, 25);
        $this->assertInstanceOf("\Aisa\Dice\Dice", $dice);
        $dice->unavailable(0);
        $res = $dice->getSum(0);
        $exp = "disabled";
        $this->assertEquals($exp, $res);
    }
}
