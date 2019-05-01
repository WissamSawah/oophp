<?php

namespace Aisa\Dice;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Dice.
*/
class DiceControllerTest extends TestCase
{
    private $controller;
    /**
    * Call the controller index action.
    */
    public function testIndexAction()
    {
        $this->controller = new DiceController();
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("Index", $res);
    }

    public function testDebugAction()
    {
        $this->controller = new DiceController();
        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("Debug my game!", $res);
    }
}
