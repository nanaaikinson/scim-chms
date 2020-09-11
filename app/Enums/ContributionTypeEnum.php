<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Tithe()
 * @method static static Busing()
 * @method static static CovenantPartner()
 * @method static static Group()
 * @method static static Welfare()
 * @method static static Pledge()
 * @method static static General()
 */
final class ContributionTypeEnum extends Enum
{
  const Tithe = 1;
  const Busing = 2;
  const CovenantPartner = 3;
  const Group = 4;
  const Welfare = 5;
  const Pledge = 6;
  const General = 7;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::CovenantPartner:
        return 'Covenant Partner';
        break;
      default:
        return self::getKey($value);
    }
  }
}
