<?php

namespace maxlzp\money;

use maxlzp\money\Exceptions\MoneyCurrencyMismatchException;

/**
 * Interface IMoney
 * @package maxlzp\money
 */
interface MoneyInterface
{
    /**
     * Adds Money of the same currency
     * @param MoneyInterface $other
     * @return MoneyInterface
     * @throws MoneyCurrencyMismatchException
     */
    public function add(MoneyInterface $other): MoneyInterface;

    /**
     * Returns an integer <0 if this amount is less than other amount;
     *  0 - if amounts are equal; >0 - if this amount is greater than other
     * @param MoneyInterface $other
     * @return int Integer
     */
    public function compare(MoneyInterface $other): int;

    /**
     * Checks whether the value represented by this object equals to the other.
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function equals(MoneyInterface $other): bool;

    /**
     * Returns amount value(in smallest possible currency units(cents, etc.))
     * @return int|number
     */
    public function getAmount(): int;

    /**
     * Returns money currency
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * Checks whether this amount is greater than the other's.
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterThan(MoneyInterface $other): bool;

    /**
     * Checks whether this amount is greater or equal than the other's.
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterOrEqualThan(MoneyInterface $other): bool;

    /**
     * Checks whether the Money is of the same Currency.
     * @param MoneyInterface $other
     * @return bool
     */
    public function isSameCurrency(MoneyInterface $other): bool;

    /**
     * @param MoneyInterface $other
     * @return mixed
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessThan(MoneyInterface $other): bool;

    /**
     * @param MoneyInterface $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessOrEqualThan(MoneyInterface $other): bool;

    /**
     * Multiplies money amount
     * @param number $factor
     * @return MoneyInterface
     */
    public function multiply(float $factor): MoneyInterface;

    /**
     * Subtracts Money of the same currency
     * @param MoneyInterface $other
     * @return MoneyInterface
     * @throws MoneyCurrencyMismatchException
     */
    public function subtract(MoneyInterface $other): MoneyInterface;
}