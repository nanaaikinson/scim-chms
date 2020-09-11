<?php

namespace App\Http\Controllers\Faker;

use App\Enums\GroupTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Faker\Factory;

class GroupFakerController extends Controller
{
  public function index()
  {
    $data = [];
    $faker = Factory::create();

    foreach (range(0, 50) as $item) {
      $data[] = Group::create([
        "name" => $faker->name,
        "description" => $faker->text($maxNbChars = 50),
        "mask" => generate_mask(),
        "type" => GroupTypeEnum::getRandomValue()
      ]);
    }

    return $data;
  }
}
