<?php
namespace maxlzp\money\Behaviours\Rounding;

/**
 * Class RoundRoundingBehaviour
 * @package maxlzp\money\Behaviours\Rounding
 */
class RoundRoundingBehaviour implements RoundingBehaviourInterface
{
    /**
     * Rounds input
     * @param float $input
     * @return int
     */
    public function round(float $input): int
    {
        return \round($input);
    }
}