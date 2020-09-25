<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::prefix("/{tenant}")->middleware([InitializeTenancyByPath::class])->group(function () {
  Route::get("/", "SpaController@tenant");

  // Staff API routes
  Route::prefix("/staff")->middleware(["json.response"])->group(function () {
    /*** Public ***/
    Route::prefix("public")->group(function () {
      Route::prefix("books")->group(function () {
        Route::get("/", "BookController@index");
      });
    });

    /*** Auth ***/
    Route::prefix("auth")->group(function () {
      Route::post("login", "Api\Staff\AuthController@login");
      Route::post("password-reset", "Api\Staff\AuthController@passwordReset");
      Route::get("user", "Api\Staff\AuthController@user")->middleware("auth:api");
      Route::post("logout", "Api\Staff\AuthController@logout")->middleware("auth:api");
    });

    /*** Protected Routes ***/
    Route::middleware("auth:api")->group(function () {
      ### Dashboard
      Route::get("/dashboard", "Api\Staff\DashboardController@index");

      ### Books
      Route::prefix("books")->group(function () {
        Route::get("/", "Api\Staff\BookController@index");
        Route::post("/", "Api\Staff\BookController@store");
        Route::get("/{id}", "Api\Staff\BookController@show");
        Route::post("/{id}", "Api\Staff\BookController@update");
        Route::delete("/{id}", "Api\Staff\BookController@destroy");
        Route::get("/{id}/generate-link", "Api\Staff\BookController@generateDownloadableLink");
      });

      ### Roles and permissions
      Route::prefix("roles")->group(function () {
        Route::get("/permissions", "Api\Staff\RoleController@permissions");

        Route::get("/", "Api\Staff\RoleController@index")->middleware("permission:read-role,guard:api");
        Route::post("/", "Api\Staff\RoleController@store")->middleware("permission:create-role,guard:api");
        Route::get("/{mask}", "Api\Staff\RoleController@show")->middleware("permission:read-role,guard:api");
        Route::put("/{mask}", "Api\Staff\RoleController@update")->middleware("permission:update-role,guard:api");
        Route::delete("/{mask}", "Api\Staff\RoleController@destroy")->middleware("permission:delete-role,guard:api");
      });

      ### Users
      Route::prefix("users")->group(function () {
        Route::get("/read-only", "Api\Staff\UserController@index");

        Route::get("/", "Api\Staff\UserController@index")->middleware("permission:read-user,guard:api");
        Route::post("/", "Api\Staff\UserController@store")->middleware("permission:create-user,guard:api");
        Route::get("/{mask}", "Api\Staff\UserController@show")->middleware("permission:read-user,guard:api");
        Route::put("/{mask}", "Api\Staff\UserController@update")->middleware("permission:update-user,guard:api");
        Route::delete("/{mask}", "Api\Staff\UserController@destroy")->middleware("permission:delete-user,guard:api");
      });

      ### Groups
      Route::prefix("groups")->group(function () {
        Route::get("/read-only", "Api\Staff\GroupController@index");

        Route::get("/", "Api\Staff\GroupController@index")->middleware("permission:read-group,guard:api");
        Route::post("/", "Api\Staff\GroupController@store")->middleware("permission:create-group,guard:api");
        Route::get("/{mask}", "Api\Staff\GroupController@show")->middleware("permission:read-group,guard:api");
        Route::put("/{mask}", "Api\Staff\GroupController@update")->middleware("permission:update-group,guard:api");
        Route::delete("/{mask}", "Api\Staff\GroupController@destroy")->middleware("permission:delete-group,guard:api");
      });

      ### People
      Route::prefix("people")->group(function () {
        Route::get("/template", "Api\Staff\PersonController@template")->middleware("permission:import-person,guard:api");
        Route::get("/import", "Api\Staff\PersonController@import")->middleware("permission:import-person,guard:api");
        Route::get("/members", "Api\Staff\PersonController@members");
        Route::get("/read-only", "Api\Staff\PersonController@members");

        Route::get("/", "Api\Staff\PersonController@index")->middleware("permission:read-person,guard:api");
        Route::post("/", "Api\Staff\PersonController@store")->middleware("permission:create-person,guard:api");
        Route::get("/{mask}", "Api\Staff\PersonController@show")->middleware("permission:read-person,guard:api");
        Route::post("/{mask}", "Api\Staff\PersonController@update")->middleware("permission:update-person,guard:api");
        Route::delete("/{mask}", "Api\Staff\PersonController@destroy")->middleware("permission:delete-person,guard:api");

        Route::middleware("permission:read-person,guard:api")->group(function () {
          Route::get("/{mask}/details", "Api\Staff\PersonController@details");
          Route::get("/{mask}/attendance", "Api\Staff\PersonController@attendance");
          Route::get("/{mask}/follow-ups", "Api\Staff\PersonController@followUp");
          Route::get("/{mask}/contributions", "Api\Staff\PersonController@contributions");
        });
      });

      ### Family
      Route::prefix("family")->group(function () {
        Route::get("/read-only", "Api\Staff\FamilyController@index");

        Route::get("/", "Api\Staff\FamilyController@index")->middleware("permission:read-family,guard:api");
        Route::post("/", "Api\Staff\FamilyController@store")->middleware("permission:create-family,guard:api");
        Route::get("/{mask}", "Api\Staff\FamilyController@show")->middleware("permission:read-family,guard:api");
        Route::put("/{mask}", "Api\Staff\FamilyController@update")->middleware("permission:update-family,guard:api");
        Route::delete("/{mask}", "Api\Staff\FamilyController@destroy")->middleware("permission:delete-family,guard:api");
      });

      ### Attendance
      Route::prefix("attendance")->group(function () {
        Route::get("/template", "Api\Staff\AttendanceController@template")->middleware("permission:create-attendance,guard:api");
        Route::get("/{mask}/download", "Api\Staff\AttendanceController@download")->middleware("permission:read-attendance,guard:api");

        Route::get("/", "Api\Staff\AttendanceController@index")->middleware("permission:read-attendance,guard:api");
        Route::post("/", "Api\Staff\AttendanceController@store")->middleware("permission:create-attendance,guard:api");
        Route::get("/{mask}", "Api\Staff\AttendanceController@show")->middleware("permission:read-attendance,guard:api");
        Route::post("/{mask}", "Api\Staff\AttendanceController@update")->middleware("permission:update-attendance,guard:api");
        Route::delete("/{mask}", "Api\Staff\AttendanceController@destroy")->middleware("permission:delete-attendance,guard:api");
      });

      ### Follow Ups
      Route::prefix("follow-up")->group(function () {

        Route::get("/", "Api\Staff\FollowUpController@index")->middleware("permission:read-follow-up,guard:api");
        Route::post("/", "Api\Staff\FollowUpController@store")->middleware("permission:create-follow-up,guard:api");
        Route::get("/{mask}", "Api\Staff\FollowUpController@show")->middleware("permission:read-follow-up,guard:api");
        Route::put("/{mask}", "Api\Staff\FollowUpController@update")->middleware("permission:update-follow-up,guard:api");
        Route::delete("/{mask}", "Api\Staff\FollowUpController@destroy")->middleware("permission:delete-follow-up,guard:api");
      });

      ### Contributions
      Route::prefix("contributions")->group(function () {
        Route::get("/", "Api\Staff\ContributionController@index")->middleware("permission:read-contribution,guard:api");
        Route::get("/template", "Api\Staff\ContributionController@template")->middleware("permission:import-contribution,guard:api");
        Route::post("/import", "Api\Staff\ContributionController@import")->middleware("permission:import-contribution,guard:api");

        ### Pledges
        Route::prefix("pledges")->group(function () {
          Route::get("/read-only", "Api\Staff\PledgeController@index");

          Route::get("/", "Api\Staff\PledgeController@index")->middleware("permission:read-contribution,guard:api");
          Route::post("/", "Api\Staff\PledgeController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\PledgeController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\PledgeController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\PledgeController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Tithe
        Route::prefix("tithes")->group(function () {
          // Route::get("/", "TitheController@index");
          Route::post("/", "Api\Staff\TitheController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\TitheController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\TitheController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\TitheController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Busing
        Route::prefix("busing")->group(function () {
          // Route::get("/", "BusingController@index");
          Route::post("/", "Api\Staff\BusingController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\BusingController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\BusingController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\BusingController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Covenant Partner
        Route::prefix("covenant-partner")->group(function () {
          // Route::get("/", "CovenantPartnerController@index");
          Route::post("/", "Api\Staff\CovenantPartnerController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\CovenantPartnerController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\CovenantPartnerController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\CovenantPartnerController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Welfare
        Route::prefix("welfare")->group(function () {
          // Route::get("/", "WelfareController@index");
          Route::post("/", "Api\Staff\WelfareController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\WelfareController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\WelfareController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\WelfareController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Group
        Route::prefix("groups")->group(function () {
          // Route::get("/", "GroupContributionController@index");
          Route::post("/", "Api\Staff\GroupContributionController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\GroupContributionController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\GroupContributionController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\GroupContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### Pledge
        Route::prefix("pledge")->group(function () {
          // Route::get("/", "PledgeContributionController@index");
          Route::post("/", "Api\Staff\PledgeContributionController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\PledgeContributionController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\PledgeContributionController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\PledgeContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
        });

        ### General
        Route::prefix("general")->group(function () {
          // Route::get("/", "GeneralContributionController@index");
          Route::post("/", "Api\Staff\GeneralContributionController@store")->middleware("permission:create-contribution,guard:api");
          Route::get("/{mask}", "Api\Staff\GeneralContributionController@show")->middleware("permission:read-contribution,guard:api");
          Route::put("/{mask}", "Api\Staff\GeneralContributionController@update")->middleware("permission:update-contribution,guard:api");
          Route::delete("/{mask}", "Api\Staff\GeneralContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
        });
      });

      ### Expenses
      Route::prefix("expenses")->group(function () {

        Route::get("/template", "Api\Staff\ExpenseController@template")->middleware("permission:import-expense,guard:api");
        Route::post("/import", "Api\Staff\ExpenseController@import")->middleware("permission:import-expense,guard:api");

        Route::get("/", "Api\Staff\ExpenseController@index")->middleware("permission:read-expense,guard:api");
        Route::post("/", "Api\Staff\ExpenseController@store")->middleware("permission:create-expense,guard:api");
        Route::get("/{mask}", "Api\Staff\ExpenseController@show")->middleware("permission:read-expense,guard:api");
        Route::put("/{mask}", "Api\Staff\ExpenseController@update")->middleware("permission:update-expense,guard:api");
        Route::delete("/{mask}", "Api\Staff\ExpenseController@destroy")->middleware("permission:delete-expense,guard:api");
      });

      ### Reports
      Route::prefix("reports")->group(function () {
        Route::get("/attendance", "Api\Staff\Report\AttendanceReportController@index")->middleware("permission:view-attendance-report,guard:api");
        Route::get("/expenses", "Api\Staff\Report\ExpenseReportController@index")->middleware("permission:view-expenses-report,guard:api");
        Route::get("/contributions", "Api\Staff\Report\ContributionReportController@index")->middleware("permission:view-contributions-report,guard:api");
      });

      ### User Profile
      Route::prefix("profile")->group(function () {
        Route::get("/", "Api\Staff\AuthController@user");
        Route::put("/change-password", "Api\Staff\AuthController@changePassword");
        Route::put("/change-details", "Api\Staff\AuthController@changeDetails");
      });

      ### Ticketing
      Route::prefix("ticketing")->group(function () {
        Route::get("/", "Api\Staff\TicketController@index");
        Route::post("/", "Api\Staff\TicketController@store");
        Route::get("/{mask}", "Api\Staff\TicketController@show");
        Route::post("/{mask}", "Api\Staff\TicketController@update");
      });

      ### Settings
      Route::prefix("settings")->group(function() {
        Route::get("/", "Api\Staff\SettingController@currency");

        Route::prefix("currency")->group(function() {
          Route::get("/all", "Api\Staff\SettingController@currencies");
          Route::get("/", "Api\Staff\SettingController@currency");
          Route::put("/", "Api\Staff\SettingController@updateCurrency");
        });
      });
    });
  });

  // Faker API routes
  Route::prefix("/faker")->group(function() {
    Route::get("/expenses", "Faker\ExpenseFakerController@index");
    Route::get("/groups", "Faker\GroupFakerController@index");
    Route::get("/people", "Faker\PersonFakerController@index");
    Route::get("/attendances", "Faker\AttendanceFakerController@index");
    Route::get("/contributions", "Faker\ContributionFakerController@index");
    Route::get("/pledges", "Faker\PledgeFakerController@index");
  });


});
