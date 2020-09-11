<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Utility()
 * @method static static Donation()
 * @method static static Welfare()
 * @method static static EquipmentAndTechnology()
 * @method static static Allowance()
 * @method static static BuildingAndConstruction()
 * @method static static Publicity()
 * @method static static Evangelism()
 */
final class ExpenseTypeEnum extends Enum
{
  const Utility = 1;
  const Donation = 2;
  const Welfare = 3;
  const EquipmentAndTechnology = 4;
  const Allowance = 5;
  const BuildingAndConstruction = 6;
  const Publicity = 7;
  const Evangelism = 8;
}
