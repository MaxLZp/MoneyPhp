<?php
/**
 * User: MaxLZp
 * @link https://github.com/MaxLZp
 */

namespace maxlzp\money;

/**
 * Class CurrencyDto
 * @package MaxLZp\Money
 */
class CurrencyDto
{
    /**
     * Currency code
     * @var string
     */
    public $code;

    /**
     * Currency ISO code
     * @var string
     */
    public $isoCode;

    /**
     * Currency name
     * @var string
     */
    public $name;

    /**
     * CurrencyDto constructor.
     * @param string $code
     * @param string $isoCode
     * @param string $name
     */
    public function __construct(
        string $code,
        string $isoCode,
        string $name
    ) {
        $this->code = $code;
        $this->isoCode = $isoCode;
        $this->name = $name;
    }
}