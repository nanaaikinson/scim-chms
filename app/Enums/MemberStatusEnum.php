<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Member()
 * @method static static Guest()
 * @method static static DistantMember()
 * @method static static PreMember()
 */
final class MemberStatusEnum extends Enum
{
  const Member = 1;
  const Guest = 2;
  const DistantMember = 3;
  const PreMember = 4;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::DistantMember:
        return 'Distant Member';
        break;
      case self::PreMember:
        return 'Pre Member';
        break;
      default:
        return self::getKey($value);
    }
  }
}
