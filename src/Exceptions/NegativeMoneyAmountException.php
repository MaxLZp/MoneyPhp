<?php
namespace MaxLZp\Money\Exceptions;

/**
 * Class NegativeMoneyAmountException
 * @package MaxLZp\Money\Exceptions
 */
class NegativeMoneyAmountException extends \Exception
{
    /**
     * NegativeMoneyAmountException constructor.
     * @param string $message
     */
    public function __construct(string $message = "Money amount cannot be less than 0.")
    {
        parent::__construct($message);
    }
}