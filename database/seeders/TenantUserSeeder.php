<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $password = bcrypt(12345678);

    $superAdmin = \App\User::create([
      "first_name" => "Admin",
      "last_name" => "Admin",
      "email" => "admin@example.com",
      "password" => $password,
      "status" => ST_ACTIVE,
      "mask" => generate_mask()
    ]);

    $superAdmin->attachRole(ST_SUPER_ADMIN);

    $developer = \App\User::create([
      "first_name" => "Nana",
      "last_name" => "Aikinson",
      "email" => "nanaaikinson24@gmail.com",
      "password" => $password,
      "status" => ST_ACTIVE,
      "mask" => generate_mask()
    ]);

    $developer->attachRole(ST_SUPER_ADMIN);
  }
}
