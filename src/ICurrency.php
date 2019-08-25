<?php
namespace MaxLZp\Money;

/**
 * Interface ICurrency
 * @package MaxLZp\Money
 */
interface ICurrency
{
    /**
     * Compares two currency instances
     * @param ICurrency $other
     * @return bool
     */
    public function equals(ICurrency $other): bool;
    /**
     * Returns currency string code
     * @return string
     */
    public function getCode(): string;
    /**
     * Returns currency iso code
     * @return number
     */
    public function getIsoCode(): number;
    /**
     * Returns currency name
     * @return string
     */
    public function getName(): string;
}