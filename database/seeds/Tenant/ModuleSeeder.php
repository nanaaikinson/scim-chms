<?php

namespace Database\Tenant;

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $modules = [
      "People", "Groups", "Family", "Reports",
      "Contributions", "Notification", "Settings",
      "Roles", "Users", "Attendance", "Follow-Ups", "Expenses"
    ];

    foreach ($modules as $module) {
      \App\Models\Module::create([
        "name" => $module,
        "description" => null,
        "mask" => generate_mask()
      ]);
    }
  }
}
