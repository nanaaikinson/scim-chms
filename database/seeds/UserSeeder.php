<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $password = bcrypt(12345678);

    User::create([
      "first_name" => "Admin",
      "last_name" => "Admin",
      "email" => "admin@example.com",
      "password" => $password,
      "status" => ST_ACTIVE,
      "mask" => generate_mask()
    ]);

    User::create([
      "first_name" => "Nana",
      "last_name" => "Aikinson",
      "email" => "nanaaikinson24@gmail.com",
      "password" => $password,
      "status" => ST_ACTIVE,
      "mask" => generate_mask()
    ]);
  }
}
