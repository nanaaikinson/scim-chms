<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Permissions
    $permissions = \App\Models\Permission::all();

    // Super Administrator
    $superAdmin = \App\Models\Role::create([
      "name" => "super-administrator",
      "display_name" => "Super Administrator",
      "mask" => generate_mask(),
    ]);

    foreach ($permissions as $permission) {
      $superAdmin->attachPermission($permission);
    }
  }
}
