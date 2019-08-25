<?php
namespace MaxLZp\Money;

/**
 * Interface ICurrency
 * @package MaxLZp\Money
 */
interface ICurrency
{
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