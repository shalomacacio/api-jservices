<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Technology extends Enum
{
    const GPON   =  1;
    const PACPON =  2;
    const RADIO  =  3;
}
