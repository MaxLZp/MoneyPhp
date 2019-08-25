<?php
namespace MaxLZp\Money\Behaviours\Rounding;

/**
 * Class RoundRoundingBehaviour
 * @package MaxLZp\Money\Behaviours\Rounding
 */
class RoundRoundingBehaviour implements IRoundingBehaviour
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