<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Group;
use App\Models\Person;
use App\Traits\ResponseTrait;
use App\User;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $gender = ["male" => 0, "female" => 0];
      $people = Person::orderBy("id", "DESC")->with("familyPersons")->with("avatar");

      $recentlyAddedPersons = $people->get()->take(10)->map(function($person) {
        $familyRelation = count($person->familyPersons) > 0 ? $person->familyPersons[0]->relation : "";
        $avatar = $person->avatar ? url("/") . $person->avatar->url : "";

        return [
          "id" => (int)$person->id,
          "mask" => (int)$person->mask,
          "name" => "{$person->first_name} {$person->last_name}",
          "email" => is_null($person->email) ? "" : $person->email,
          "avatar" => $avatar,
          "primary_telephone" => is_null($person->primary_telephone) ? "" : $person->primary_telephone,
          "created_at" => gmdate("Y-m-d", strtotime($person->created_at)),
          "family_relation" => $familyRelation,
          "member_status" => $person->member_status == ST_MEMBER ? "Member" : "Guest"
        ];
      });

      $people->get()->each(function($person) use (&$gender) {
        if (strtolower($person->gender) == "male") {
          $gender["male"] += 1;
        } else {
          $gender["female"] += 1;
        }
      });

      $total = [
        "people" => $people->get()->count(),
        "users" => User::count(),
        "families" => Family::count(),
        "groups" => Group::count()
      ];

      return $this->dataResponse([
        "total" => $total,
        "gender" => $gender,
        "people" => $recentlyAddedPersons
      ]);
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
