<?php

namespace App\Http\Controllers\Faker;

use App\Http\Controllers\Controller;
use App\Models\Pledge;
use Faker\Factory;
use Illuminate\Http\Request;

class PledgeFakerController extends Controller
{
  public function index()
  {
    $data = [];
    $faker = Factory::create();

    foreach (range(0, 10) as $index) {
      $data[] = Pledge::create([
        "title" => $faker->name,
        "purpose" => $faker->text,
        "amount" => $faker->randomFloat(2, 0, 99999),
        "mask" => generate_mask()
      ]);
    }

    return $data;
  }
}
