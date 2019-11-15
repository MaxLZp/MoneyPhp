<?php
namespace maxlzp\money;


class CurrencyConstants
{
    const SUPPORTED_CURRENCIES = [
        'USD' => [
            'name' => 'US Dollar',
            'isoCode' => '840',
        ],
        'EUR' => [
            'name' => 'Euro',
            'isoCode' => '978',
        ],
        'UAH' => [
            'name' => 'Hryvnia',
            'isoCode' => '980',
        ],
        'RUB' => [
            'name' => 'Russian Ruble',
            'isoCode' => '643',
        ],
        'GBP' => [
            'name' => 'Pound Sterling',
            'isoCode' => '826',
        ],
        'CZK' => [
            'name' => 'Czech Koruna',
            'isoCode' => '203',
        ],
    ];
}