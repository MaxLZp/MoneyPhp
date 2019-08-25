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
     * @return string
     */
    public function getIsoCode(): string;

    /**
     * Returns currency name
     * @return string
     */
    public function getName(): string;
}