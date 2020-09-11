<?php

namespace App\Http\Controllers\Faker;

use App\Enums\ExpenseTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Faker\Factory;
use Illuminate\Http\Request;

class ExpenseFakerController extends Controller
{
  public function index()
  {
    $faker = Factory::create();
    $data = [];

    foreach (range(0, 1000) as $index) {
      $data[] = Expense::create([
        "name" => $faker->name,
        "mask" => generate_mask(),
        "amount" => $faker->randomNumber(2),
        "type" => ExpenseTypeEnum::getRandomValue(),
        "date" => $faker->date($format = 'Y-m-d', $max = 'now')
      ]);
    }

    return $data;
  }
}
