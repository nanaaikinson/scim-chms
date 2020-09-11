<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static General()
 * @method static static Group()
 * @method static static Event()
 */
final class AttendanceTypeEnum extends Enum
{
  const General = 1;
  const Group = 2;
  const Event = 3;
}
