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
     * Returns all supported currencies
     * @return array
     */
    public function getAll(): array;

    /**
     * Return CurrencyDto. Possibly from some storage/
     * @param string $currencyCode
     * @return mixed
     */
    public function getWithCode(string $currencyCode): CurrencyDto;
}