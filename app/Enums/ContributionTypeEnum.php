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
 * @method static static AlterSeed()
 * @method static static Offering()
 */
final class ContributionTypeEnum extends Enum
{
  const Tithe = 1;
  const Busing = 2;
  const CovenantPartner = 3;
  const Group = 4;
  const Welfare = 5;
  const Pledge = 6;
  const Offering = 7;
  const AlterSeed = 8;
  const General = 9;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::CovenantPartner:
        return 'Covenant Partner';
      case self::AlterSeed:
        return 'Alter Seed';
      default:
        return self::getKey($value);
    }
  }
}
