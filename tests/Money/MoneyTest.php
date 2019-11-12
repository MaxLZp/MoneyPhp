<?php

namespace maxlzp\money\tests;

use MaxLZp\Money\Currency;
use MaxLZp\Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * Class MoneyTest
 * @package maxlzp\money\tests
 */
class MoneyTest extends TestCase
{
    /**
     *
     */
    protected static function createDollarsCurrency()
    {
        return new Currency('USD', 'US Dollars', '840');
    }

    /**
     *
     */
    protected static function createEurosCurrency()
    {
        return new Currency('EUR', 'Euros', '978');
    }

    /**
     * @test
     */
    public function shouldCreate5USCents()
    {
        $expectedValue = 5;
        $expectedCurrency = new Currency('USD', 'US Dollar', 840);
        $fiveCents = Money::USD(5);

        $this->assertEquals($expectedValue, $fiveCents->getAmount());
        $this->assertEquals($expectedCurrency, $fiveCents->getCurrency());
    }

    /**
     * @test
     */
    public function Money_constructor_success()
    {
        $money = new Money(123, self::createDollarsCurrency());
        $this->assertNotNull($money);
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\NegativeMoneyAmountException
     */
    public function Money_constructor_shouldThrowExceptionForNegativeAmount()
    {
        $money = new Money(-123, self::createDollarsCurrency());
        $this->assertNotNull($money);
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_add_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $money1->add($money2);
    }

    /**
     * @test
     */
    public function Money_compare_ShouldBeSummed()
    {
        $expectedValue = 246;
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $sum = $money1->add($money2);

        $this->assertEquals($expectedValue, $sum->getAmount());
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_compare_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->compare($money2);
    }

    /**
     * @test
     */
    public function Money_compare_SholdBe0ForEqualMoney()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertEquals(0, $money1->compare($money2));
    }

    /**
     * @test
     */
    public function Money_compare_ShouldBeLessThan0ForMoneyLessThanOther()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(234, self::createDollarsCurrency());

        $this->assertTrue($money1->compare($money2) < 0);
    }

    /**
     * @test
     */
    public function Money_compare_ShouldBeGreaterThan0ForMoneyGreaterhanOther()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(0, self::createDollarsCurrency());

        $this->assertTrue($money1->compare($money2) > 0);
    }

    /**
     * @test
     */
    public function Money_equals_ShouldBeTrueForEqualMoney()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertTrue($money1->equals($money2));
    }

    /**
     * @test
     */
    public function Money_equals_ShouldBeFalseForDifferentMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(124, self::createDollarsCurrency());

        $this->assertFalse($money1->equals($money2));
        $this->assertFalse($money2->equals($money1));
    }

    /**
     * @test
     */
    public function Money_equals_ShouldBeFalseForDifferentMoneyCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $this->assertFalse($money1->equals($money2));
    }

    /**
     * @test
     */
    public function Money_isSameCurrency_ShouldBeTrueForSameMoneyCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertTrue($money1->isSameCurrency($money2));
    }

    /**
     * @test
     */
    public function Money_isSameCurrency_ShouldBeFalseForDifferentMoneyCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $this->assertFalse($money1->isSameCurrency($money2));
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_isGreaterThan_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->isGreaterThan($money2);
    }

    /**
     * @test
     */
    public function Money_isGreaterThan_TrueForBiggerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(0, self::createDollarsCurrency());

        $this->assertTrue($money1->isGreaterThan($money2));
    }

    /**
     * @test
     */
    public function Money_isGreaterThan_FalseForEqualMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertFalse($money1->isGreaterThan($money2));
    }

    /**
     * @test
     */
    public function Money_isGreaterThan_FalseForSmallerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(1000, self::createDollarsCurrency());

        $this->assertFalse($money1->isGreaterThan($money2));
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_isGreaterOrEqualThan_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->isGreaterOrEqualThan($money2);
    }

    /**
     * @test
     */
    public function Money_isGreaterOrEqualThan_TrueForBiggerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(0, self::createDollarsCurrency());

        $this->assertTrue($money1->isGreaterOrEqualThan($money2));
    }

    /**
     * @test
     */
    public function Money_isGreaterOrEqualThan_TrueForEqualMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertTrue($money1->isGreaterOrEqualThan($money2));
    }

    /**
     * @test
     */
    public function Money_isGreaterOrEqualThan_FalseForSmallerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(1000, self::createDollarsCurrency());

        $this->assertFalse($money1->isGreaterOrEqualThan($money2));
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_isLessThan_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->isLessThan($money2);
    }

    /**
     * @test
     */
    public function Money_isLessThan_TrueForSmallerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(1000, self::createDollarsCurrency());

        $this->assertTrue($money1->isLessThan($money2));
    }

    /**
     * @test
     */
    public function Money_isLessThan_FalseForEqualMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertFalse($money1->isLessThan($money2));
    }

    /**
     * @test
     */
    public function Money_isLessThan_FalseForBiggerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(0, self::createDollarsCurrency());

        $this->assertFalse($money1->isLessThan($money2));
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_isLessOrEqualThan_ShouldThrowExceptionForMoenyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->isLessOrEqualThan($money2);
    }

    /**
     * @test
     */
    public function Money_isLessOrEqualThan_TrueForSmallerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(1000, self::createDollarsCurrency());

        $this->assertTrue($money1->isLessOrEqualThan($money2));
    }

    /**
     * @test
     */
    public function Money_isLessOrEqualThan_TrueForEqualMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createDollarsCurrency());

        $this->assertTrue($money1->isLessOrEqualThan($money2));
    }

    /**
     * @test
     */
    public function Money_isLessOrEqualThan_FalseForBiggerMoneyAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(0, self::createDollarsCurrency());

        $this->assertFalse($money1->isLessOrEqualThan($money2));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function Money_multiply_shouldThrowExceptionForNegativeFactor()
    {
        $initialValue = 123;
        $factor = -2;
        $expectedValue = $initialValue * $factor;
        $money1 = new Money($initialValue, self::createDollarsCurrency());

        $result = $money1->multiply($factor)->getAmount();
    }

    /**
     * @test
     */
    public function Money_multiply_integerFactor()
    {
        $initialValue = 123;
        $factor = 2;
        $expectedValue = $initialValue * $factor;
        $money1 = new Money($initialValue, self::createDollarsCurrency());

        $this->assertEquals($expectedValue, $money1->multiply($factor)->getAmount());
    }

    /**
     * @test
     */
    public function Money_multiply_floatFactor()
    {
        $initialValue = 123;
        $factor = 2.456;
        $expectedValue = \round($initialValue * $factor);
        $money1 = new Money($initialValue, self::createDollarsCurrency());

        $multiplied = $money1->multiply($factor)->getAmount();

        $this->assertEquals($expectedValue, $multiplied);
    }


    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\MoneyCurrencyMismatchException
     */
    public function Money_subtract_ShouldThrowExceptionForMoneyWithMismatchingCurrencies()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(123, self::createEurosCurrency());

        $result = $money1->subtract($money2);
    }

    /**
     * @test
     * @expectedException MaxLZp\Money\Exceptions\NegativeMoneyAmountException
     */
    public function Money_subtract_ShouldThrowExceptionWhenSubtractingBiggerAmount()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(200, self::createDollarsCurrency());

        $result = $money1->subtract($money2);
    }

    /**
     * @test
     */
    public function Money_subtract_NormalFlow()
    {
        $money1 = new Money(123, self::createDollarsCurrency());
        $money2 = new Money(23, self::createDollarsCurrency());
        $expectedValue = 123 - 23;

        $rest = $money1->subtract($money2);

        $this->assertEquals($expectedValue, $rest->getAmount());
    }
}
