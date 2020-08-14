<?php
/**
 * User: MaxLZp
 * @link https://github.com/MaxLZp
 */

namespace maxlzp\money\tests;

use MaxLZp\Money\CurrencyDto;
use maxlzp\money\DefaultCurrenciesSource;
use maxlzp\money\Exceptions\CurrencyUnsupportedException;

/**
 * Class DefaultCurrenciesSourceTest
 * @package maxlzp\money\tests
 */
class DefaultCurrenciesSourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance to run test on
     * @var DefaultCurrenciesSource
     */
    protected $source;

    /**
     * DefaultCurrenciesSourceTest constructor.
     */
    public function __construct()
    {
        $this->source = new DefaultCurrenciesSource();
    }

    /**
     * @test
     */
    public function shouldCreateCurrenciesSource()
    {
        $source = new DefaultCurrenciesSource();
        $this->assertNotNull($source);
    }

    /**
     * @test
     */
    public function shouldFindCurrency()
    {
        $currencyCode = 'USD';

        $currencyDto = $this->source->getWithCode($currencyCode);

        $this->assertNotNull($currencyDto);
        $this->assertEquals($currencyCode, $currencyDto->code);

    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenCurrencyIsUnsupported()
    {
        $this->setExpectedException(CurrencyUnsupportedException::class);
        $currencyCode = 'CAD'; //Canadian dollar

        $currencyDto = $this->source->getWithCode($currencyCode);
    }

    /**
     * @test
     */
    public function getAllShouldReturnCurrencyDtoArray()
    {
        $currencies = $this->source->getAll();
        $this->assertGreaterThan(0, \count($currencies));
        $this->assertInstanceOf(CurrencyDto::class, $currencies[0]);
    }
}
