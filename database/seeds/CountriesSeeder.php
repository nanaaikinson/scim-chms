<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $countries = json_decode(file_get_contents(base_path("/countries.json")), true);
    foreach ($countries as $country) {
      Country::create([
        "name" => $country["name"],
        "alpha_2_Code" => $country["alpha2Code"] ?: NULL,
        "alpha_3_Code" => $country["alpha3Code"] ?: NULL,
        "calling_code" => !empty($country["callingCodes"]) ? $country["callingCodes"][0] : NULL,
        "currency" => !empty($country["currencies"]) ? json_encode($country["currencies"][0]) : NULL,
        "flag" => $country["flag"] ?: NULL,
      ]);
    }
  }
}
