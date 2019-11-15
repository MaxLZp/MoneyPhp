<?php

namespace maxlzp\money;

use maxlzp\money\Exceptions\MoneyCurrencyMismatchException;

/**
 * Interface IMoney
 * @package maxlzp\money
 */
interface IMoney
{
    /**
     * Adds Money of the same currency
     * @param IMoney $other
     * @return IMoney
     * @throws MoneyCurrencyMismatchException
     */
    public function add(IMoney $other): IMoney;

    /**
     * Returns an integer <0 if this amount is less than other amount;
     *  0 - if amounts are equal; >0 - if this amount is greater than other
     * @param IMoney $other
     * @return int Integer
     */
    public function compare(IMoney $other): int;

    /**
     * Checks whether the value represented by this object equals to the other.
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function equals(IMoney $other): bool;

    /**
     * Returns amount value(in smallest possible currency units(cents, etc.))
     * @return int|number
     */
    public function getAmount(): int;

    /**
     * Returns money currency
     * @return ICurrency
     */
    public function getCurrency(): ICurrency;

    /**
     * Checks whether this amount is greater than the other's.
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterThan(IMoney $other): bool;

    /**
     * Checks whether this amount is greater or equal than the other's.
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isGreaterOrEqualThan(IMoney $other): bool;

    /**
     * Checks whether the Money is of the same Currency.
     * @param IMoney $other
     * @return bool
     */
    public function isSameCurrency(IMoney $other): bool;

    /**
     * @param IMoney $other
     * @return mixed
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessThan(IMoney $other): bool;

    /**
     * @param IMoney $other
     * @return bool
     * @throws MoneyCurrencyMismatchException
     */
    public function isLessOrEqualThan(IMoney $other): bool;

    /**
     * Multiplies money amount
     * @param number $factor
     * @return IMoney
     */
    public function multiply(float $factor): IMoney;

    /**
     * Subtracts Money of the same currency
     * @param IMoney $other
     * @return IMoney
     * @throws MoneyCurrencyMismatchException
     */
    public function subtract(IMoney $other): IMoney;
}