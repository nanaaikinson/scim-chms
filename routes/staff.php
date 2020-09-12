<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["json.response"])->group(function () {
  /*** Public ***/
  Route::prefix("public")->group(function () {
    Route::prefix("books")->group(function () {
      Route::get("/", "BookController@index");
    });
  });

  /*** Auth ***/
  Route::prefix("auth")->group(function () {
    Route::post("login", "AuthController@login");
    Route::post("password-reset", "AuthController@passwordReset");
    Route::get("user", "AuthController@user")->middleware("auth:api");
    Route::post("logout", "AuthController@logout")->middleware("auth:api");
  });

  /*** Protected Routes ***/
  Route::middleware("auth:api")->group(function () {
    ### Dashboard
    Route::get("/dashboard", "DashboardController@index");

    ### Books
    Route::prefix("books")->group(function () {
      Route::get("/", "BookController@index");
      Route::post("/", "BookController@store");
      Route::get("/{id}", "BookController@show");
      Route::post("/{id}", "BookController@update");
      Route::delete("/{id}", "BookController@destroy");
      Route::get("/{id}/generate-link", "BookController@generateDownloadableLink");
    });

    ### Roles and permissions
    Route::prefix("roles")->group(function () {
      Route::get("/permissions", "RoleController@permissions");

      Route::get("/", "RoleController@index")->middleware("permission:read-role,guard:api");
      Route::post("/", "RoleController@store")->middleware("permission:create-role,guard:api");
      Route::get("/{mask}", "RoleController@show")->middleware("permission:read-role,guard:api");
      Route::put("/{mask}", "RoleController@update")->middleware("permission:update-role,guard:api");
      Route::delete("/{mask}", "RoleController@destroy")->middleware("permission:delete-role,guard:api");
    });

    ### Users
    Route::prefix("users")->group(function () {
      Route::get("/read-only", "UserController@index");

      Route::get("/", "UserController@index")->middleware("permission:read-user,guard:api");
      Route::post("/", "UserController@store")->middleware("permission:create-user,guard:api");
      Route::get("/{mask}", "UserController@show")->middleware("permission:read-user,guard:api");
      Route::put("/{mask}", "UserController@update")->middleware("permission:update-user,guard:api");
      Route::delete("/{mask}", "UserController@destroy")->middleware("permission:delete-user,guard:api");
    });

    ### Groups
    Route::prefix("groups")->group(function () {
      Route::get("/read-only", "GroupController@index");

      Route::get("/", "GroupController@index")->middleware("permission:read-group,guard:api");
      Route::post("/", "GroupController@store")->middleware("permission:create-group,guard:api");
      Route::get("/{mask}", "GroupController@show")->middleware("permission:read-group,guard:api");
      Route::put("/{mask}", "GroupController@update")->middleware("permission:update-group,guard:api");
      Route::delete("/{mask}", "GroupController@destroy")->middleware("permission:delete-group,guard:api");
    });

    ### People
    Route::prefix("people")->group(function () {
      Route::get("/template", "PersonController@template")->middleware("permission:import-person,guard:api");
      Route::get("/import", "PersonController@import")->middleware("permission:import-person,guard:api");
      Route::get("/members", "PersonController@members");
      Route::get("/read-only", "PersonController@members");

      Route::get("/", "PersonController@index")->middleware("permission:read-person,guard:api");
      Route::post("/", "PersonController@store")->middleware("permission:create-person,guard:api");
      Route::get("/{mask}", "PersonController@show")->middleware("permission:read-person,guard:api");
      Route::post("/{mask}", "PersonController@update")->middleware("permission:update-person,guard:api");
      Route::delete("/{mask}", "PersonController@destroy")->middleware("permission:delete-person,guard:api");

      Route::middleware("permission:read-person,guard:api")->group(function() {
        Route::get("/{mask}/details", "PersonController@details");
        Route::get("/{mask}/attendance", "PersonController@attendance");
        Route::get("/{mask}/follow-ups", "PersonController@followUp");
        Route::get("/{mask}/contributions", "PersonController@contributions");
      });
    });

    ### Family
    Route::prefix("family")->group(function () {
      Route::get("/read-only", "FamilyController@index");

      Route::get("/", "FamilyController@index")->middleware("permission:read-family,guard:api");
      Route::post("/", "FamilyController@store")->middleware("permission:create-family,guard:api");
      Route::get("/{mask}", "FamilyController@show")->middleware("permission:read-family,guard:api");
      Route::put("/{mask}", "FamilyController@update")->middleware("permission:update-family,guard:api");
      Route::delete("/{mask}", "FamilyController@destroy")->middleware("permission:delete-family,guard:api");
    });

    ### Attendance
    Route::prefix("attendance")->group(function () {
      Route::get("/template", "AttendanceController@template")->middleware("permission:create-attendance,guard:api");
      Route::get("/{mask}/download", "AttendanceController@download")->middleware("permission:read-attendance,guard:api");

      Route::get("/", "AttendanceController@index")->middleware("permission:read-attendance,guard:api");
      Route::post("/", "AttendanceController@store")->middleware("permission:create-attendance,guard:api");
      Route::get("/{mask}", "AttendanceController@show")->middleware("permission:read-attendance,guard:api");
      Route::post("/{mask}", "AttendanceController@update")->middleware("permission:update-attendance,guard:api");
      Route::delete("/{mask}", "AttendanceController@destroy")->middleware("permission:delete-attendance,guard:api");
    });

    ### Follow Ups
    Route::prefix("follow-up")->group(function () {

      Route::get("/", "FollowUpController@index")->middleware("permission:read-follow-up,guard:api");
      Route::post("/", "FollowUpController@store")->middleware("permission:create-follow-up,guard:api");
      Route::get("/{mask}", "FollowUpController@show")->middleware("permission:read-follow-up,guard:api");
      Route::put("/{mask}", "FollowUpController@update")->middleware("permission:update-follow-up,guard:api");
      Route::delete("/{mask}", "FollowUpController@destroy")->middleware("permission:delete-follow-up,guard:api");
    });

    // Contributions
    Route::prefix("contributions")->group(function () {
      Route::get("/", "ContributionController@index")->middleware("permission:read-contribution,guard:api");
      Route::get("/template", "ContributionController@template")->middleware("permission:import-contribution,guard:api");
      Route::post("/import", "ContributionController@import")->middleware("permission:import-contribution,guard:api");

      ### Pledges
      Route::prefix("pledges")->group(function () {
        Route::get("/read-only", "PledgeController@index");

        Route::get("/", "PledgeController@index")->middleware("permission:read-contribution,guard:api");
        Route::post("/", "PledgeController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "PledgeController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "PledgeController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "PledgeController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Tithe
      Route::prefix("tithes")->group(function () {
        // Route::get("/", "TitheController@index");
        Route::post("/", "TitheController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "TitheController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "TitheController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "TitheController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Busing
      Route::prefix("busing")->group(function () {
        // Route::get("/", "BusingController@index");
        Route::post("/", "BusingController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "BusingController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "BusingController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "BusingController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Covenant Partner
      Route::prefix("covenant-partner")->group(function () {
        // Route::get("/", "CovenantPartnerController@index");
        Route::post("/", "CovenantPartnerController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "CovenantPartnerController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "CovenantPartnerController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "CovenantPartnerController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Welfare
      Route::prefix("welfare")->group(function () {
        // Route::get("/", "WelfareController@index");
        Route::post("/", "WelfareController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "WelfareController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "WelfareController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "WelfareController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Group
      Route::prefix("groups")->group(function () {
        // Route::get("/", "GroupContributionController@index");
        Route::post("/", "GroupContributionController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "GroupContributionController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "GroupContributionController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "GroupContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### Pledge
      Route::prefix("pledge")->group(function () {
        // Route::get("/", "PledgeContributionController@index");
        Route::post("/", "PledgeContributionController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "PledgeContributionController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "PledgeContributionController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "PledgeContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
      });

      ### General
      Route::prefix("general")->group(function () {
        // Route::get("/", "GeneralContributionController@index");
        Route::post("/", "GeneralContributionController@store")->middleware("permission:create-contribution,guard:api");
        Route::get("/{mask}", "GeneralContributionController@show")->middleware("permission:read-contribution,guard:api");
        Route::put("/{mask}", "GeneralContributionController@update")->middleware("permission:update-contribution,guard:api");
        Route::delete("/{mask}", "GeneralContributionController@destroy")->middleware("permission:delete-contribution,guard:api");
      });
    });

    ### Expenses
    Route::prefix("expenses")->group(function () {

      Route::get("/template", "ExpenseController@template")->middleware("permission:import-expense,guard:api");
      Route::post("/import", "ExpenseController@import")->middleware("permission:import-expense,guard:api");

      Route::get("/", "ExpenseController@index")->middleware("permission:read-expense,guard:api");
      Route::post("/", "ExpenseController@store")->middleware("permission:create-expense,guard:api");
      Route::get("/{mask}", "ExpenseController@show")->middleware("permission:read-expense,guard:api");
      Route::put("/{mask}", "ExpenseController@update")->middleware("permission:update-expense,guard:api");
      Route::delete("/{mask}", "ExpenseController@destroy")->middleware("permission:delete-expense,guard:api");
    });

    // Reports
    Route::prefix("reports")->group(function() {
      Route::get("/attendance", "Report\AttendanceReportController@index")->middleware("permission:view-attendance-report,guard:api");
      Route::get("/expenses", "Report\ExpenseReportController@index")->middleware("permission:view-expenses-report,guard:api");
      Route::get("/contributions", "Report\ContributionReportController@index")->middleware("permission:view-contributions-report,guard:api");
    });

    ### User Profile
    Route::prefix("profile")->group(function() {
      Route::get("/", "AuthController@user");
      Route::put("/change-password", "AuthController@changePassword");
      Route::put("/change-details", "AuthController@changeDetails");
    });
  });
});
