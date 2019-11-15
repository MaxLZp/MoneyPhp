<?php
namespace MaxLZp\Money;

use MaxLZp\Money\Behaviours\Rounding\RoundingBehaviourFactory;
use MaxLZp\Money\Behaviours\Rounding\RoundingBehaviourFactoryConstants;
use MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException;
use MaxLZp\Money\Exceptions\NegativeMoneyAmountException;

/**
 * Class Money
 * @package MaxLZp\Money
 */
class Money implements IMoney
{
    /**
     * Money amount value(in smallest possible currency units(cents, etc.)
     * @var int
     */
    protected $amount;
    /**
     * @var ICurrency
     */
    protected $currency;
    /**
     * @var int
     */
    protected $roundingMode;

    /**
     * Money constructor.
     * @param int $amount
     * @param ICurrency $currency
     * @throws NegativeMoneyAmountException
     */
    public function __construct(
        int $amount,
        ICurrency $currency,
        $roundingMode = RoundingBehaviourFactoryConstants::MODE_ROUND)
    {
        $this->guardNegativeAmount($amount);
        $this->amount = $amount;
        $this->currency = $currency;
        $this->roundingMode = $roundingMode;
    }

    /**
     * Magic factory method to create IMoney instances with
     * Currency as method name
     *
     * Creating 5 cents:
     * Money::USD(5) => new Money(5, new Currency('USD', 'US Dollars'));
     * Creating 1 EURO:
     * Money::EUR(100) => new Money(100, new Currency('EUR', 'Euro'));
     *
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        return new self($arguments[0], Currency::$name());
    }

    /**
     * Adds Money of the same currency
     * @param IMoney $other
     * @return IMoney
     * @throws MoneyCurrencyMismatchException
     */
    public function add(IMoney $other): IMoney
    {
        $this->guardCurrencyMismatch($other);
        return new self($this->getAmount() + $other->getAmount(), $this->getCurrency());
    }

    /**
     * Returns an integer <0 if this amount is less than other amount;
     *  0 - if amounts are equal; >0 - if this amount is greater than other
     * @param IMoney $other
     * @return int Integer
     * @throws MoneyCurrencyMismatchException
     */
    public function compare(IMoney $other): int
    {
        $this->guardCurrencyMismatch($other);
        return $this->getAmount() - $other->getAmount();
    }

    /**
     * Checks whether the value represented by this object equals to the other.
     * @param IMoney $other
     * @return bool
     */
    public function equals(IMoney $other): bool
    {
        if ($this->isSameCurrency($other))
        {
            return $this->compare($other) === 0;
        }
        return false;
    }

    /**
     * Returns amount value(in smallest possible currency units(cents, etc.))
     * @return int|number
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Returns money currency
     * @return ICurrency
     */
    public function getCurrency(): ICurrency
    {
        return $this->currency;
    }

    /**
     * Checks whether this amount is greater than the other's.
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterThan(IMoney $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) > 0;
    }

    /**
     * Checks whether this amount is greater or equal than the other's.
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterOrEqualThan(IMoney $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) >= 0;
    }

    /**
     * Checks whether the Money is of the same Currency.
     * @param IMoney $other
     * @return bool
     */
    public function isSameCurrency(IMoney $other): bool
    {
        return $this->getCurrency()->equals($other->getCurrency());
    }

    /**
     * @param IMoney $other
     * @return mixed
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessThan(IMoney $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) < 0;
    }

    /**
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessOrEqualThan(IMoney $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) <= 0;
    }

    /**
     * Multiplies money amount
     * @param number $factor
     * @return IMoney
     */
    public function multiply(float $factor): IMoney
    {
        $this->guardNegativeFactor($factor);
        $newAmount = $this->round($this->getAmount() * $factor);
        return new self($newAmount, $this->getCurrency());
    }

    /**
     * Subtracts Money of the same currency
     * @param IMoney $other
     * @return IMoney
     * @throws MoneyCurrencyMismatchException
     * @throws NegativeMoneyAmountException
     */
    public function subtract(IMoney $other): IMoney
    {
        $this->guardCurrencyMismatch($other);
        $this->guardBiggerAmountSubtraction($other);
        return new self($this->getAmount() - $other->getAmount(),
            $this->getCurrency());
    }

    /**
     * @param IMoney $other
     * @throws NegativeMoneyAmountException
     */
    public function guardBiggerAmountSubtraction(IMoney $other): void
    {
        if ($this->isLessThan($other))
            throw new NegativeMoneyAmountException("Money subtraction result cannot be negative");
    }

    /**
     * @param IMoney $other
     * @throws MoneyCurrencyMismatchException
     */
    protected function guardCurrencyMismatch(IMoney $other): void
    {
        if ($this->getCurrency()->equals($other->getCurrency()))
            return;
        throw new MoneyCurrencyMismatchException();
    }

    /**
     * @param IMoney $other
     * @throws NegativeMoneyAmountException
     */
    protected function guardNegativeAmount(int $amount): void
    {
        if ($amount < 0) throw new NegativeMoneyAmountException();
    }

    /**
     * @param float $factor
     * @throws NegativeMoneyAmountException
     */
    protected function guardNegativeFactor(float $factor): void
    {
        if ($factor < 0)
            throw new \InvalidArgumentException("Factor cannot be less than 0");
    }

    /**
     * @param float $value
     * @return int
     */
    protected function round(float $value): int
    {
        return RoundingBehaviourFactory::create($this->roundingMode)->round($value);
    }
}