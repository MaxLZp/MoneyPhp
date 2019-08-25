<?php
namespace MaxLZp\Money\Behaviours\Rounding;

/**
 * Interface IRoundingBehaviour
 * @package MaxLZp\Money\Behaviours\Rounding
 */
interface IRoundingBehaviour
{
    /**
     * Rounds input
     * @param float $input
     * @return int
     */
    public function round(float $input): int;
}