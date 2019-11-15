<?php

namespace maxlzp\money\Behaviours\Rounding;

/**
 * Interface IRoundingBehaviour
 * @package maxlzp\money\Behaviours\Rounding
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