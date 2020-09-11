<?php

namespace App\Http\Controllers\Faker;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Group;
use App\Models\Person;
use App\Models\Pledge;
use Faker\Factory;
use Illuminate\Http\Request;

class ContributionFakerController extends Controller
{
  public function index()
  {
    $data = [];
    $faker = Factory::create();
    $groups = Group::inRandomOrder()->select("id")->limit("25")->pluck("id")->toArray();
    $people = Person::inRandomOrder()->select("id")->pluck("id")->toArray();
    $pledges = Pledge::inRandomOrder()->select("id")->pluck("id")->toArray();

    foreach (range(0, 1000) as $index) {
      $person = $faker->randomElement($people);
      $type = ContributionTypeEnum::getRandomValue();
      $pledge = $faker->randomElement($pledges);
      $group = $faker->randomElement($groups);

      $data[] = Contribution::create([
        "person_id" => $person,
        "amount" => $faker->randomFloat(2, 0, 99999),
        "type" => $type,
        "date" => $faker->date("Y-m-d"),
        "method" => ContributionMethodEnum::getRandomValue(),
        "pledge_id" => $type == ContributionTypeEnum::Pledge ? $pledge : NULL,
        "group_id" => $type == ContributionTypeEnum::Group ? $group : NULL,
        "frequency" => $type == ContributionTypeEnum::Tithe ? $faker->randomElement(["Weekly", "Monthly"]) : NULL,
        "mask" => generate_mask()
      ]);
    }

    return $data;
  }
}
