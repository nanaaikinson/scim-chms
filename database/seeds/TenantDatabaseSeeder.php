<?php

use App\Models\Country;
use App\Models\Module;
use App\Models\Permission;
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
    #################### Modules ####################
    $modules = [
      "People", "Groups", "Family", "Reports",
      "Contributions", "Notification", "Settings",
      "Roles", "Users", "Attendance", "Follow-Ups", "Expenses"
    ];

    foreach ($modules as $module) {
      Module::create([
        "name" => $module,
        "description" => null,
        "mask" => generate_mask()
      ]);
    }
    #################### Modules ####################

    #################### Permissions ####################
    Permission::insert([
      [
        "name" => "create-role", "display_name" => "create role", "module_id" => ST_MOD_ROLES,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-role", "display_name" => "view role", "module_id" => ST_MOD_ROLES,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-role", "display_name" => "update role", "module_id" => ST_MOD_ROLES,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-role", "display_name" => "delete role", "module_id" => ST_MOD_ROLES,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ]
    ]);

    // Users
    Permission::insert([
      [
        "name" => "create-user", "display_name" => "create user", "module_id" => ST_MOD_USERS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-user", "display_name" => "view user", "module_id" => ST_MOD_USERS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-user", "display_name" => "update user", "module_id" => ST_MOD_USERS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-user", "display_name" => "delete user", "module_id" => ST_MOD_USERS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ]
    ]);

    // Groups
    Permission::insert([
      [
        "name" => "create-group", "display_name" => "create group", "module_id" => ST_MOD_GROUPS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-group", "display_name" => "view group", "module_id" => ST_MOD_GROUPS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-group", "display_name" => "update group", "module_id" => ST_MOD_GROUPS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-group", "display_name" => "delete group", "module_id" => ST_MOD_GROUPS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ]
    ]);

    // Family
    Permission::insert([
      [
        "name" => "create-family", "display_name" => "create family", "module_id" => ST_MOD_FAMILY,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-family", "display_name" => "view family", "module_id" => ST_MOD_FAMILY,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-family", "display_name" => "update family", "module_id" => ST_MOD_FAMILY,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-family", "display_name" => "delete family", "module_id" => ST_MOD_FAMILY,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ]
    ]);

    // People
    Permission::insert([
      [
        "name" => "create-person", "display_name" => "create person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-person", "display_name" => "view person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-person", "display_name" => "update person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-person", "display_name" => "delete person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "import-person", "display_name" => "import person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "export-person", "display_name" => "export person", "module_id" => ST_MOD_PEOPLE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);

    // Attendance
    Permission::insert([
      [
        "name" => "create-attendance", "display_name" => "create attendance", "module_id" => ST_MOD_ATTENDANCE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-attendance", "display_name" => "view attendance", "module_id" => ST_MOD_ATTENDANCE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-attendance", "display_name" => "update attendance", "module_id" => ST_MOD_ATTENDANCE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-attendance", "display_name" => "delete attendance", "module_id" => ST_MOD_ATTENDANCE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);

    // Follow Up
    Permission::insert([
      [
        "name" => "create-follow-up", "display_name" => "create follow-up", "module_id" => ST_MOD_FOLLOW_UP,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-follow-up", "display_name" => "view follow-up", "module_id" => ST_MOD_FOLLOW_UP,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-follow-up", "display_name" => "update follow-up", "module_id" => ST_MOD_FOLLOW_UP,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-follow-up", "display_name" => "delete follow-up", "module_id" => ST_MOD_FOLLOW_UP,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);

    // Contribution
    Permission::insert([
      [
        "name" => "create-contribution", "display_name" => "create contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-contribution", "display_name" => "view contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-contribution", "display_name" => "update contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-contribution", "display_name" => "delete contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "import-contribution", "display_name" => "import contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "export-contribution", "display_name" => "export contribution", "module_id" => ST_MOD_CONTRIBUTIONS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);

    // Expense
    Permission::insert([
      [
        "name" => "create-expense", "display_name" => "create expense", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "read-expense", "display_name" => "view expenses", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "update-expense", "display_name" => "update expense", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "delete-expense", "display_name" => "delete expense", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "import-expense", "display_name" => "import expense", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "export-expense", "display_name" => "export expense", "module_id" => ST_MOD_EXPENSE,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);

    // Report
    Permission::insert([
      [
        "name" => "view-attendance-report", "display_name" => "view attendance report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "view-expenses-report", "display_name" => "view expenses report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "view-people-report", "display_name" => "view people report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "view-contributions-report", "display_name" => "view contributions report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "view-follow-up-report", "display_name" => "view follow-up report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "view-leaders-report", "display_name" => "view leaders report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "import-leaders-report", "display_name" => "upload leaders report", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
      [
        "name" => "upload-leaders-report", "display_name" => "upload leaders report template", "module_id" => ST_MOD_REPORTS,
        "created_at" => gmdate("Y-m-d H:i:s"), "updated_at" => gmdate("Y-m-d H:i:s")
      ],
    ]);
    #################### Permissions ####################

    #################### Roles ####################
    // Permissions
    $permissions = Permission::all();

    // Super Administrator
    $superAdmin = \App\Models\Role::create([
      "name" => "super-administrator",
      "display_name" => "Super Administrator",
      "mask" => generate_mask(),
    ]);

    foreach ($permissions as $permission) {
      $superAdmin->attachPermission($permission);
    }
    #################### Roles ####################

    #################### Users ####################
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
    #################### Roles ####################

    #################### Countries ####################
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
    #################### Countries ####################
  }
}
