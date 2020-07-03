<?php

namespace maxlzp\money;

/**
 * Class Currency
 * @package maxlzp\money
 */
class Currency implements CurrencyInterface
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
     * @var CurrenciesSourceInterface
     */
    protected static $currenciesSource;

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
     * @return Currency
     */
    public static function __callStatic($name, $arguments)
    {
        self::initSupportedCurrencies();
        $currencyDto = self::$currenciesSource->getWithCode($name);
        return new self(
            $name,
            $currencyDto->name,
            $currencyDto->isoCode
        );
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CurrencyInterface $other): bool
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
     * @param CurrencyInterface $other
     * @return bool
     */
    protected function codesAreEqual(CurrencyInterface $other): bool
    {
        return $this->stringsAreEqual($this->getCode(), $other->getCode());
    }

    /**
     * Init array of supported currencies with initial values.
     */
    protected static function initSupportedCurrencies()
    {
        if (null === self::$currenciesSource) {
            self::$currenciesSource = new DefaultCurrenciesSource();
        }
    }

    /**
     * @param CurrencyInterface $other
     * @return bool
     */
    protected function isoCodesAreEqual(CurrencyInterface $other): bool
    {
        return $this->stringsAreEqual($this->getIsoCode(), $other->getIsoCode());
    }

    /**
     * Reset supported currencies array with data provided.
     * @param CurrenciesSourceInterface $source
     */
    protected static function resetCurrenciesSource(CurrenciesSourceInterface $source)
    {
        self::$currenciesSource = $source;
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