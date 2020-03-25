<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentType extends Enum
{
    const AVISTA    =   1;
    const DEBITO    =   2;
    const CREDITO   =   3;
    const BOLETO    =   4;
    const GRATUITO  =   5;
}
