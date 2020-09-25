<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Bug()
 * @method static static Suggestion()
 * @method static static Feature()
 */
final class TicketTagEnum extends Enum
{
  const Bug = 1;
  const Suggestion = 2;
  const Feature = 3;
}
