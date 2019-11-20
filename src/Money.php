<?php
namespace maxlzp\money;

use maxlzp\money\Behaviours\Rounding\RoundingBehaviourFactory;
use maxlzp\money\Behaviours\Rounding\RoundingBehaviourFactoryConstants;
use maxlzp\money\Exceptions\MoneyCurrencyMismatchException;
use maxlzp\money\Exceptions\NegativeMoneyAmountException;

/**
 * Class Money
 * @package maxlzp\money
 */
class Money implements MoneyInterface
{
    /**
     * Money amount value(in smallest possible currency units(cents, etc.)
     * @var int
     */
    protected $amount;
    /**
     * @var CurrencyInterface
     */
    protected $currency;
    /**
     * @var int
     */
    protected $roundingMode;

    /**
     * Money constructor.
     * @param int $amount
     * @param CurrencyInterface $currency
     * @throws NegativeMoneyAmountException
     */
    public function __construct(
        int $amount,
        CurrencyInterface $currency,
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
     * @param MoneyInterface $other
     * @return MoneyInterface
     * @throws MoneyCurrencyMismatchException
     */
    public function add(MoneyInterface $other): MoneyInterface
    {
        $this->guardCurrencyMismatch($other);
        return new self($this->getAmount() + $other->getAmount(), $this->getCurrency());
    }

    /**
     * Returns an integer <0 if this amount is less than other amount;
     *  0 - if amounts are equal; >0 - if this amount is greater than other
     * @param MoneyInterface $other
     * @return int Integer
     * @throws MoneyCurrencyMismatchException
     */
    public function compare(MoneyInterface $other): int
    {
        $this->guardCurrencyMismatch($other);
        return $this->getAmount() - $other->getAmount();
    }

    /**
     * Checks whether the value represented by this object equals to the other.
     * @param MoneyInterface $other
     * @return bool
     */
    public function equals(MoneyInterface $other): bool
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
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * Checks whether this amount is greater than the other's.
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterThan(MoneyInterface $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) > 0;
    }

    /**
     * Checks whether this amount is greater or equal than the other's.
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterOrEqualThan(MoneyInterface $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) >= 0;
    }

    /**
     * Checks whether the Money is of the same Currency.
     * @param MoneyInterface $other
     * @return bool
     */
    public function isSameCurrency(MoneyInterface $other): bool
    {
        return $this->getCurrency()->equals($other->getCurrency());
    }

    /**
     * @param MoneyInterface $other
     * @return mixed
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessThan(MoneyInterface $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) < 0;
    }

    /**
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessOrEqualThan(MoneyInterface $other): bool
    {
        $this->guardCurrencyMismatch($other);
        return $this->compare($other) <= 0;
    }

    /**
     * Multiplies money amount
     * @param number $factor
     * @return MoneyInterface
     */
    public function multiply(float $factor): MoneyInterface
    {
        $this->guardNegativeFactor($factor);
        $newAmount = $this->round($this->getAmount() * $factor);
        return new self($newAmount, $this->getCurrency());
    }

    /**
     * Subtracts Money of the same currency
     * @param MoneyInterface $other
     * @return MoneyInterface
     * @throws MoneyCurrencyMismatchException
     * @throws NegativeMoneyAmountException
     */
    public function subtract(MoneyInterface $other): MoneyInterface
    {
        $this->guardCurrencyMismatch($other);
        $this->guardBiggerAmountSubtraction($other);
        return new self($this->getAmount() - $other->getAmount(),
            $this->getCurrency());
    }

    /**
     * @param MoneyInterface $other
     * @throws NegativeMoneyAmountException
     */
    public function guardBiggerAmountSubtraction(MoneyInterface $other): void
    {
        if ($this->isLessThan($other))
            throw new NegativeMoneyAmountException("Money subtraction result cannot be negative");
    }

    /**
     * @param MoneyInterface $other
     * @throws MoneyCurrencyMismatchException
     */
    protected function guardCurrencyMismatch(MoneyInterface $other): void
    {
        if ($this->getCurrency()->equals($other->getCurrency()))
            return;
        throw new MoneyCurrencyMismatchException();
    }

    /**
     * @param MoneyInterface $other
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