<?php

namespace maxlzp\money\Behaviours\Rounding;

/**
 * Interface RoundingBehaviourInterface
 * @package maxlzp\money\Behaviours\Rounding
 */
interface RoundingBehaviourInterface
{
    /**
     * Rounds input
     * @param float $input
     * @return int
     */
    public function round(float $input): int;
}