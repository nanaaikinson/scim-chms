<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Chart()
 * @method static static Table()
 * @method static static Count()
 */
final class ReportReturnTypeEnum extends Enum
{
  const Chart = 1;
  const Table = 2;
  const Count = 3;
}
