<?php
namespace maxlzp\money\Exceptions;

/**
 * Class MoneyCurrencyMismatchException
 * @package maxlzp\money\Exceptions
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