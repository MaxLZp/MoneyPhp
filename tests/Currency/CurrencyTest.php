<?php
namespace maxlzp\money\tests;

use PHPUnit\Framework\TestCase;
use MaxLZp\Money\Currency;

/**
 * Class CurrencyTest
 * @package Tests
 */
class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function Currency_constructor_createsInstanceWithDefaultIsoCodeSetToZero()
    {
        $expectedCode = 'USD';
        $expectedName = 'US Dollar';
        $expectedIsoCode = '0';
        $currency = new Currency($expectedCode, $expectedName);

        $this->assertNotNull($currency);
        $this->assertEquals($expectedCode, $currency->getCode());
        $this->assertEquals($expectedIsoCode, $currency->getIsoCode());
        $this->assertEquals($expectedName, $currency->getName());
    }

    /**
     * @test
     */
    public function Currency_constructor_createsInstanceWithIsoCode()
    {
        $expectedCode = 'USD';
        $expectedName = 'US Dollar';
        $expectedIsoCode = '840';
        $currency = new Currency($expectedCode, $expectedName, $expectedIsoCode);

        $this->assertNotNull($currency);
        $this->assertEquals($expectedCode, $currency->getCode());
        $this->assertEquals($expectedIsoCode, $currency->getIsoCode());
        $this->assertEquals($expectedName, $currency->getName());
    }

    /**
     * @test
     */
    public function Currency_callStatic_shouldCreateUSCents()
    {
        $expectedCurrency = new Currency('USD', 'US Dollar', 840);
        $cents = Currency::USD();

        $this->assertEquals($expectedCurrency, $cents);
    }

    /**
     * @test
     */
    public function Currency_callStatic_CreateCurrencyFromArgument()
    {
        $arguments = [
            'USD' => [
                'name' => 'US Dollar',
                'isoCode' => '840',
            ],
        ];
        $expectedCurrency = new Currency('USD', 'US Dollar', 840);
        $money = Currency::USD($arguments);

        $this->assertEquals($expectedCurrency, $money);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function Currency_callStatic_FailsToCreateCurrencyFromArgumentWhenCurrencyIsNotList()
    {
        $arguments = [
            'USD' => [
                'name' => 'US Dollar',
                'isoCode' => '840',
            ],
        ];
        $money = Currency::EUR($arguments);
    }
    /**
     * @test
     */
    public function Currency_equals_twoIdenticalCurrenciesAreEqual()
    {
        $code = 'USD';
        $name = 'US Dollar';
        $isoCode = '840';
        $currency1 = new Currency($code, $name, $isoCode);
        $currency2 = new Currency($code, $name, $isoCode);

        $this->assertTrue($currency1->equals($currency2));
    }

    /**
     * @test
     */
    public function Currency_equals_CurrenciesWithSameCodeButDifferentNamesAreEqual()
    {
        $code = 'USD';
        $name1 = 'US Dollar';
        $name2 = 'US Dollars';
        $isoCode = '840';
        $currency1 = new Currency($code, $name1, $isoCode);
        $currency2 = new Currency($code, $name2, $isoCode);

        $this->assertTrue($currency1->equals($currency2));
        $currency1->getCode();
    }

    /**
     * @test
     */
    public function Currency_equals_CurrenciesWithSameCodeInDifferentCasesAreEqual()
    {
        $code1 = 'USD';
        $code2 = 'usd';
        $name = 'US Dollar';
        $isoCode = '840';
        $currency1 = new Currency($code1, $name, $isoCode);
        $currency2 = new Currency($code2, $name, $isoCode);

        $this->assertTrue($currency1->equals($currency2));
        $currency1->getCode();
    }

    /**
     * @test
     */
    public function Currency_equals_DifferentCurrenciesAreDifferent()
    {
        $code1 = 'USD';
        $code2 = 'EUR';
        $name = 'US Dollar';
        $isoCode1 = '840';
        $isoCode2 = '978';
        $currency1 = new Currency($code1, $name, $isoCode1);
        $currency2 = new Currency($code2, $name, $isoCode2);

        $this->assertFalse($currency1->equals($currency2));
        $currency1->getCode();
    }

    /**
     * @test
     */
    public function Currency_equals_CurrenciesWithDifferentCodeAreDifferent()
    {
        $code1 = 'USD';
        $code2 = 'EUR';
        $name = 'US Dollar';
        $isoCode = '840';
        $currency1 = new Currency($code1, $name, $isoCode);
        $currency2 = new Currency($code2, $name, $isoCode);

        $this->assertFalse($currency1->equals($currency2));
        $currency1->getCode();
    }

    /**
     * @test
     */
    public function Currency_equals_CurrenciesWithDifferentIsoCodeAreDifferent()
    {
        $code = 'USD';
        $name = 'US Dollar';
        $isoCode1 = '840';
        $isoCode2 = '0';
        $currency1 = new Currency($code, $name, $isoCode1);
        $currency2 = new Currency($code, $name, $isoCode2);

        $this->assertFalse($currency1->equals($currency2));
        $currency1->getCode();
    }
}
