<?php
namespace MaxLZp\Money\Exceptions;

/**
 * Class MoneyCurrencyMismatchException
 * @package MaxLZp\Money\Exceptions
 */
class MoneyCurrencyMismatchException extends \Exception
{
    /**
     * MoneyCurrencyMismatchException constructor.
     * @param string $message
     */
    public function __construct(string $message = "Money-operands currency mismatch.")
    {
        parent::__construct($message);
    }
}