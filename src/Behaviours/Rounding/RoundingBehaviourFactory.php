<?php
namespace MaxLZp\Money\Behaviours\Rounding;

/**
 * Class RoundingBehaviourFactory
 * @package MaxLZp\Money\Behaviours\Rounding
 */
class RoundingBehaviourFactory
{
    /**
     * @param int $mode
     * @return IRoundingBehaviour
     */
    public static function create(int $mode) : IRoundingBehaviour
    {
        switch ($mode) {
            case RoundingBehaviourFactoryConstants::MODE_ROUND:
                return self::createRound();
                break;
            default:
                return self::createRound();
        }
    }

    /**
     * @return IRoundingBehaviour
     */
    protected static function createRound(): IRoundingBehaviour
    {
        return new RoundRoundingBehaviour();
    }
}