<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OperationType extends Enum
{
    // operations type for calculate commissions
    const FIXO    =   1;
    const PERCENT =   2;
}
