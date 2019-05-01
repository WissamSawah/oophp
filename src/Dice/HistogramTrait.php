<?php
namespace Aisa\Dice;

/**
 * A trait implementing histogram for integers.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }
    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return string representing the histogram.
     */
    public function printHistogram(int $min = null, int $max = null)
    {
        $duplicates = array_count_values($this->serie);
        //check if parameters are null and sort
        if ($min !== null && $max !== null) {
            $this->min = 1;
            for ($i=$min; $i <= $max; $i++) {
                if (!array_key_exists($i, $duplicates)) {
                    $duplicates[$i] = 0;
                }
            }
            ksort($duplicates);
        }
        $html = null;
        $stars = null;
        $html .= '<ul style="list-style: none;">';
        foreach ($duplicates as $key => $value) {
            for ($i=0; $i < $value; $i++) {
                $stars .= '*';
            }
            $html .= '<li>' . $key . ': ' . $stars . '</li>';
            $stars = '';
        }
        $html .= '</ul>';
        return $html;
    }
}
