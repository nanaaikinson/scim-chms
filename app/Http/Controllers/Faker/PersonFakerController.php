<?php

namespace App\Http\Controllers\Faker;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupPerson;
use App\Models\Person;
use App\Traits\ResponseTrait;
use Faker\Factory;
use Illuminate\Http\Request;

class PersonFakerController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $data = [];
      $faker = Factory::create();
      $groups = Group::inRandomOrder()->select("id")->limit("25")->pluck("id")->toArray();

      foreach (range(0, 250) as $index) {
        $person = Person::create([
          "first_name" => $faker->firstName,
          "last_name" => $faker->lastName,
          "gender" => $faker->randomElement(["Male", "Female"]),
          "email" => $faker->companyEmail,
          "date_of_birth" => $faker->date('Y-m-d'),
          "mask" => generate_mask(),
          "occupation" => $faker->jobTitle
        ]);

        $group = $faker->randomElement($groups);
        GroupPerson::create(["group_id" => $group, "person_id" => $person->id]);

        $data[] = $person;
      }

      return $data;
    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
