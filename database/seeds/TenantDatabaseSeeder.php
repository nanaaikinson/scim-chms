<?php

use Database\Tenant\ModuleSeeder;
use Database\Tenant\PermissionSeeder;
use Database\Tenant\RoleSeeder;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $this->call(ModuleSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
  }
}
