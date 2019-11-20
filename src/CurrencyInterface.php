<?php

namespace maxlzp\money;

/**
 * Interface CurrencyInterface
 * @package maxlzp\money
 */
interface CurrencyInterface
{
    /**
     * Compares two currency instances
     * @param CurrencyInterface $other
     * @return bool
     */
    public function equals(CurrencyInterface $other): bool;

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