<?php
/**
 * User: MaxLZp
 * @link https://github.com/MaxLZp
 */

namespace maxlzp\money\Exceptions;

/**
 * Class CurrencyUnsupportedException
 * @package MaxLZp\Money\Exceptions
 */
class CurrencyUnsupportedException extends \Exception
{
    /**
     * CurrencyUnsupportedException constructor.
     * @param string $currencyCode
     */
    public function __construct(string $currencyCode)
    {
        parent::__construct($this->createMessage($currencyCode));
    }

    /**
     * @param $currencyCode
     * @return string
     */
    protected function createMessage($currencyCode): string
    {
        return "{$currencyCode} is not supported.";
    }
}