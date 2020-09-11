<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Day()
 * @method static static Month()
 * @method static static Year()
 * @method static static Period()
 * @method static static Week()
 */
final class ReportDurationEnum extends Enum
{
  const Day = 1;
  const Week = 2;
  const Month = 3;
  const Year = 4;
  const Period = 5;
}
