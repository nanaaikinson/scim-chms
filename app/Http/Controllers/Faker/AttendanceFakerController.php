<?php

namespace App\Http\Controllers\Faker;

use App\Enums\AttendanceTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendancePerson;
use App\Models\Group;
use App\Models\Person;
use App\Traits\ResponseTrait;
use Faker\Factory;
use Illuminate\Http\Request;

class AttendanceFakerController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    $faker = Factory::create();
    $people = Person::inRandomOrder()->select("id")->limit(50)->pluck("id")->toArray();
    $groups = Group::all()->pluck("id")->toArray();
    $data = [];

    foreach (range(0, 150) as $index) {
      $type = AttendanceTypeEnum::getRandomValue();
      $attendance = Attendance::create([
        "name" => $faker->name,
        "date" => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        "mask" => generate_mask(),
        "type" => $type,
        "group_id" => $type == 2 ? $faker->randomElement($groups) : NULL
      ]);

      foreach ($people as $p) {
        AttendancePerson::create([
          "attendance_id" => $attendance->id,
          "person_id" => $p,
          "status" => $faker->randomElement([0,1])
        ]);
      }

      $data[] = $attendance;
    }

    return $data;
  }
}
