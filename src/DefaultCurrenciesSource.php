<?php
/**
 * User: MaxLZp
 * @link https://github.com/MaxLZp
 */

namespace maxlzp\money;

use maxlzp\money\Exceptions\CurrencyUnsupportedException;

/**
 * Class DefaultCurrenciesSource
 * @package MaxLZp\Money
 */
class DefaultCurrenciesSource implements CurrenciesSourceInterface
{
    /**
     * @var
     */
    protected $data;

    /**
     * DefaultCurrenciesSource constructor.
     */
    public function __construct()
    {
        $this->data = [
            'USD' => [
                'name' => 'US Dollar',
                'isoCode' => '840',
            ],
            'EUR' => [
                'name' => 'Euro',
                'isoCode' => '978',
            ],
            'UAH' => [
                'name' => 'Hryvnia',
                'isoCode' => '980',
            ],
            'RUB' => [
                'name' => 'Russian Ruble',
                'isoCode' => '643',
            ],
            'GBP' => [
                'name' => 'Pound Sterling',
                'isoCode' => '826',
            ],
            'CZK' => [
                'name' => 'Czech Koruna',
                'isoCode' => '203',
            ],
        ];
    }

    /**
     * Return CurrencyDto. Possibly from some storage/
     * @param string $currencyCode
     * @return CurrencyDto
     * @throws CurrencyUnsupportedException
     */
    public function getWithCode(string $currencyCode): CurrencyDto
    {
        if (\array_key_exists($currencyCode, $this->data))
        {
            return new CurrencyDto(
                $currencyCode,
                $this->data[$currencyCode]['isoCode'],
                $this->data[$currencyCode]['name']
            );
        }
        throw new CurrencyUnsupportedException($currencyCode);
    }
}