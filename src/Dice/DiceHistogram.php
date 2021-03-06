<?php
namespace Aisa\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram extends Dice implements HistogramInterface
{
    use HistogramTrait;
    /**
    * Get max value for the histogram.
    *
    * @return int with the max value.
    */
    public function getHistogramMax()
    {
        return 6;
    }
    /**
    * Get max value for the histogram.
    *
    * @return int with the max value.
    */
    public function getHistogramMin()
    {
        return 1;
    }
}
