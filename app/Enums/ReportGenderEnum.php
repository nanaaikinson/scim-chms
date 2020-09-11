<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Male()
 * @method static static Female()
 * @method static static All()
 */
final class ReportGenderEnum extends Enum
{
  const Male = 1;
  const Female = 2;
  const All = 3;
}
