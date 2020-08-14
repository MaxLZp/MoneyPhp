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
        $this->initData();
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
            return $this->createDto($currencyCode, $this->data[$currencyCode]);
        }
        throw new CurrencyUnsupportedException($currencyCode);
    }

    /**
     * Returns al supported currencies
     * @return array
     */
    public function getAll(): array
    {
        return array_map(
            function($key, $value) {
                return $this->createDto($key, $value);
            },
            array_keys($this->data),
            $this->data);
    }

    /**
     * Create CurrencyDto
     * @param $code $code
     * @param $info Currency information
     * @return CurrencyDto
     */
    protected function createDto($code, $info): CurrencyDto
    {
        return new CurrencyDto(
            $code,
            $info['isoCode'],
            $info['name']
        );
    }

    /**
     * Init $this->data array
     */
    protected function initData(): void
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
}