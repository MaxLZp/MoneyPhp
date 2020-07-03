<?php
/**
 * User: MaxLZp
 * @link https://github.com/MaxLZp
 */

namespace maxlzp\money;

/**
 * Interface CurrenciesSourceInterface
 * @package MaxLZp\Money
 */
interface CurrenciesSourceInterface
{
    /**
     * Return CurrencyDto. Possibly from some storage/
     * @param string $currencyCode
     * @return mixed
     */
    public function getWithCode(string $currencyCode): CurrencyDto;
}