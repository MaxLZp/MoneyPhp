<?php
namespace maxlzp\money\Behaviours\Rounding;

/**
 * Class RoundingBehaviourFactory
 * @package maxlzp\money\Behaviours\Rounding
 */
class RoundingBehaviourFactory
{
    /**
     * @param int $mode
     * @return RoundingBehaviourInterface
     */
    public static function create(int $mode) : RoundingBehaviourInterface
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
     * @return RoundingBehaviourInterface
     */
    protected static function createRound(): RoundingBehaviourInterface
    {
        return new RoundRoundingBehaviour();
    }
}