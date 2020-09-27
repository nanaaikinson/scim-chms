<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static VisitIdl()
 * @method static static Phone()
 * @method static static Message()
 * @method static static VisitWelp()
 */
final class FollowUpEnum extends Enum
{
  const VisitIdl = 1;
  const VisitWelp = 2;
  const Phone = 3;
  const Message = 4;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::VisitIdl:
        $stringName = 'Visit - Identify and locate';
        break;
      case self::VisitWelp:
        $stringName = 'Visit - Word, encouragement and prayer';
        break;
      default:
        $stringName = self::getKey($value);
        break;
    }

    return $stringName;
  }
}
