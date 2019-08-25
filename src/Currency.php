<?php

namespace MaxLZp\Money;

/**
 * Class Currency
 * @package MaxLZp\Money
 */
class Currency implements ICurrency
{
    /**
     * @var string Currency string-code
     */
    protected $code;
    /**
     * @var string Currency iso-code
     */
    protected $isoCode;
    /**
     * @var Currency name
     */
    protected $name;

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
     * @param ICurrency $other
     * @return bool
     */
    protected function isoCodesAreEqual(ICurrency $other): bool
    {
        return $this->stringsAreEqual($this->getIsoCode(), $other->getIsoCode());
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