<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Children()
 * @method static static Men()
 * @method static static SmallGroups()
 * @method static static Youth()
 * @method static static Women()
 */
final class GroupTypeEnum extends Enum
{
  const Children = 1;
  const Men = 2;
  const SmallGroups = 3;
  const Youth = 4;
  const Women = 5;
  const Workers = 6;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::SmallGroups:
        $stringName = 'Small Groups';
        break;
      default:
        $stringName = self::getKey($value);
        break;
    }

    return $stringName;
  }
}
