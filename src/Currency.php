<?php

namespace maxlzp\money;

/**
 * Class Currency
 * @package maxlzp\money
 */
class Currency implements ICurrency
{
    /**
     * @var string Currency string-code
     */
    protected $code;

    /**
     * Currency ISO code (ISO-4217)
     * @var string Currency iso-code
     */
    protected $isoCode;

    /**
     * @var Currency name
     */
    protected $name;

    /**
     * @var
     */
    protected static $supportedCurrencies;

    /**
     * Currency constructor.
     * @param string $code
     * @param string $name
     * @param string $isoCode
     */
    public function __construct(
        string $code,
        string $name,
        string $isoCode = '0'
    )
    {
        $this->code = $code;
        $this->isoCode = $isoCode;
        $this->name = $name;
    }

    /**
     * Magic factory method to create ICurrency instances with
     * Currency as method name
     *
     * Creating USD:
     * Currency::USD => new Currency('USD', 'US Dollars');
     * Creating EURO:
     * Currency::EUR(100) => new Currency('EUR', 'Euro'))
     *
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        self::initSupportedCurrencies();
        self::resetSupportedCurrencies($arguments);

        if (self::isSupportedCurrency(self::$supportedCurrencies, $name)) {
            return new self(
                $name,
                self::$supportedCurrencies[$name]['name'],
                self::$supportedCurrencies[$name]['isoCode']
            );
        }
        throw new \InvalidArgumentException('Request currency is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function equals(ICurrency $other): bool
    {
        return $this->codesAreEqual($other) &&
            $this->isoCodesAreEqual($other);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->getCode();
    }

    /**
     * @param ICurrency $other
     * @return bool
     */
    protected function codesAreEqual(ICurrency $other): bool
    {
        return $this->stringsAreEqual($this->getCode(), $other->getCode());
    }

    /**
     * Init array of supported currencies with initial values.
     */
    protected static function initSupportedCurrencies()
    {
        if (null === self::$supportedCurrencies) {
            self::$supportedCurrencies = CurrencyConstants::SUPPORTED_CURRENCIES;
        }
    }

    /**
     * @param ICurrency $other
     * @return bool
     */
    protected function isoCodesAreEqual(ICurrency $other): bool
    {
        return $this->stringsAreEqual($this->getIsoCode(), $other->getIsoCode());
    }

    /**
     * Checks if currency is supported or not
     * @param array $currencies
     * @param $currencyName
     * @return bool
     */
    protected static function isSupportedCurrency($currencies, $currencyName): bool
    {
        return \array_key_exists($currencyName, $currencies);
    }

    /**
     * Reset supported currencies array with data provided.
     * @param $arguments
     */
    protected static function resetSupportedCurrencies($arguments)
    {
        if (\count($arguments) && (\is_array($arguments[0]))) {
            self::$supportedCurrencies = $arguments[0];
        }
    }

    /**
     * @param string $first
     * @param string $second
     * @return bool
     */
    protected function stringsAreEqual(string $first, string $second)
    {
        return \strcasecmp($first, $second) === 0;
    }
}