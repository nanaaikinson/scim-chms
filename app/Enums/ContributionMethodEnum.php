<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Cash()
 * @method static static Cheque()
 * @method static static Online()
 * @method static static MobileMoney()
 */
final class ContributionMethodEnum extends Enum
{
  const Cash = 1;
  const Cheque = 2;
  const Online = 3;
  const MobileMoney = 4;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::MobileMoney:
        $stringName = 'Mobile Money';
        break;
      default:
        $stringName = self::getKey($value);
        break;
    }

    return $stringName;
  }
}
