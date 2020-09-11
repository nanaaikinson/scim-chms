<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Visit()
 * @method static static Phone()
 * @method static static Message()
 */
final class FollowUpEnum extends Enum
{
    const Visit =   1;
    const Phone =   2;
    const Message = 3;
}
