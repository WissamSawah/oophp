<?php

namespace Aisa\Dice;

/**
 * A dicehand, consisting of dices.
 */

class Dice
{
    /**
    * @var Dice $dices   Array consisting of dices.
    * @var int  $values  Array consisting of last roll of the dices.
    */
    public $player1;
    public $player2;
    private $player1Turn = [];
    private $player2Turn = [];
    private $player1Dice = [];
    private $player2Dice = [];
    private $player1DicesHisto    = [];
    private $player2DicesHisto    = [];
    private $btnOff = ["", ""];

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct($player1 = 0, $player2 = 0)
    {
        $this->$player1       = $player1;
        $this->$player2       = $player2;
        $this->player1Turn    = [];
        $this->player2Turn    = [];
        $this->player1Dice    = [];
        $this->player2Dice    = [];
        $this->btnOff         = ["", ""];
    }

    /**
     * change button class if 1 appers and give turn to next player
     *
     * @return int
     */
    public function unavailable($number)
    {
        $this->btnOff[$number] = "disabled";
        //enable the other one
        switch ($number) {
            case 0:
                $this->btnOff[$number + 1] = "";
                break;
            case 1:
                $this->btnOff[$number - 1] = "";
                break;
        }
    }


    public function rollPlayer1()
    {
        $this->unavailable(1);

        //roll the round
        for ($i = 0; $i < 3; $i++) {
            $this->round[$i] = rand(1, 6);
        }

        // add the round to html page
        for ($i = 0; $i < 3; $i++) {
            $this->player1Turn[] = $this->round[$i];
            $this->player1DicesHisto[] = $this->round[$i];
        }

        //unavailable button depend on turn
        if (in_array(1, $this->round)) {
            $this->unavailable(0);
        }

        //if number one in dice turn do not add to the sum
        if (in_array(1, $this->round)) {
            for ($i = 0; $i < 3; $i++) {
                $this->round[$i] = 0;
            }
        }

        //reset the round by adding 0 to round
        for ($i=0; $i < 3; $i++) {
            $this->player1Dice[] = $this->round[$i];
        }
        $this->player1Turn[] = "<br>";
    }



    public function rollPlayer2()
    {
        $this->unavailable(0);

        //roll the round
        for ($i = 0; $i < 3; $i++) {
            $this->round[$i] = rand(1, 6);
        }

        // add the round to html page
        for ($i = 0; $i < 3; $i++) {
            $this->player2Turn[] = $this->round[$i];
            $this->player2DicesHisto[] = $this->round[$i];
        }

        //unavailable button depend on turn
        if (in_array(1, $this->round)) {
            $this->unavailable(1);
        }

        //if number one in dice turn do not add to the sum
        if (in_array(1, $this->round)) {
            for ($i = 0; $i < 3; $i++) {
                $this->round[$i] = 0;
            }
        }


        //reset the round by adding 0 to round
        for ($i=0; $i < 3; $i++) {
            $this->player2Dice[] = $this->round[$i];
        }

        $this->player2Turn[] = "<br>";

        if ($this->allResults(0) < $this->allResults(1)) {
            $this->unavailable(1);
        }
        $player1 = array_count_values($this->player1DicesHisto);
        $player2 = array_count_values($this->player2DicesHisto);
        //check ones (1) on histogram
        if (isset($player1[1]) > isset($player2[1])) {
            $this->unavailable(1);
        }
    }

    /**
     * Save values of all dices
     *
     * @return void.
     */
    public function getDices($number)
    {
        $results = [$this->player1Turn, $this->player2Turn];
        return $results[$number];
    }


    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function getDicesHistogram($number)
    {
        $results = [$this->player1DicesHisto, $this->player2DicesHisto];
        return $results[$number];
    }



    public function allResults($number)
    {
        $results = [array_sum($this->player1Dice), array_sum($this->player2Dice)];
        if ($results[$number] >= 100) {
            $this->unavailable(0);
            $this->unavailable(1);
            return "You Win!!";
        }
        return $results[$number];
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function getSum($number)
    {
        return $this->btnOff[$number];
    }
}
