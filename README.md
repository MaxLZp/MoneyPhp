# Money

### Create
```php
$fiveCents = Money::USD(5);
$oneEuro = Money::EUR(100); 
```

### Reset supported currencies

Create a class implementing CurrenciesSourceInterface:
```php
class UpdatedCurrenciesSource implements CurrenciesSourceInterface
{
    protected $data = [
            'USD' => [
                'name' => 'US Dollar',
                'isoCode' => '840',
            ],
        ];
        
    /**
     * Return CurrencyDto. Possibly from some storage/
     * @param string $currencyCode
     * @return CurrencyDto
     * @throws CurrencyUnsupportedException
     */
    public function getWithCode(string $currencyCode): CurrencyDto
    {
        if (\array_key_exists($currencyCode, $this->data))
        {
            return new CurrencyDto(
                $currencyCode,
                $this->data[$currencyCode]['isoCode'],
                $this->data[$currencyCode]['name']
            );
        }
        throw new CurrencyUnsupportedException($currencyCode);
    }
}
```

Reset currencies source at Currency class:
```php
Currency::resetCurrenciesSource(new UpdatedCurrenciesSource());
```