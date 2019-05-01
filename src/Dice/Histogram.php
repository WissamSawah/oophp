<?php
namespace Aisa\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    public $min;
    public $max;
    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText($serie)
    {
        $duplicates = array_count_values($serie);
        $stars = null;
        for ($i=$this->min; $i <= $this->max; $i++) {
            if (!array_key_exists($i, $duplicates)) {
                $duplicates[$i] = 0;
            }
        }
        ksort($duplicates);
        $html = null;
        $html .= '<ul class="list-group">';
        foreach ($duplicates as $key => $value) {
            for ($i=0; $i < $value; $i++) {
                $stars .= '*';
            }
            $html .= '<li class="list-group-item">' . $key . ': ' . $stars . '</li>';
            $stars = null;
        }
        $html.= '</ul>';
        return $html;
    }
    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }
}
