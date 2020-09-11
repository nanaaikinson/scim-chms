<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyPerson;
use App\Models\Person;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $families = Family::with("persons")->get()->map(function ($family) {
        return [
          "id" => $family->id,
          "mask" => $family->mask,
          "name" => $family->name,
          "persons" => $family->persons->count()
        ];
      });

      return $this->dataResponse($families);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = ["name" => "required"];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      // Process data
      DB::beginTransaction();

      $family = new Family();
      $family->name = $request->name;
      $family->mask = generate_mask();

      if ($family->save()) {
        if ($request->people) {
          foreach ($request->people as $p) {
            $p = (object)$p;

            // Find person
            $person = Person::with("familyPersons")->where("id", (int)$p->id)->first();
            if ($person) {

              // Person belongs to a family
              if ($person->familyPersons) {
                foreach ($person->familyPersons as $familyPerson) {
                  $familyPerson->delete();
                }
              }

              // Add person to this family
              FamilyPerson::create(["family_id" => $family->id, "person_id" => $person->id, "relation" => $p->relation]);
            }
          }
        }

        DB::commit();
        return $this->successResponse("Family created successfully.");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this family");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $family = Family::with("persons")->where("mask", $mask)->firstOrFail();
      $persons = $family->persons->map(function ($person) {

        return [
          "id" => $person->id,
          "name" => "{$person->first_name} {$person->last_name}",
          "relation" => $person->familyPersons ? $person->familyPersons[0]->relation : null
        ];
      });

      return $this->dataResponse([
        "id" => $family->id,
        "mask" => $family->mask,
        "name" => $family->name,
        "people" => $persons
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this family");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $family = Family::with("familyPersons")->where("mask", $mask)->firstOrFail();
      $familyPersons = $family->familyPersons;

      $rules = ["name" => "required"];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      // Process data
      DB::beginTransaction();

      $family->name = $request->name;
      if ($family->save()) {
        if ($request->people) {
          foreach ($familyPersons as $p) {
            $p->delete();
          }

          foreach ($request->people as $p) {
            $p = (object)$p;

            // Find person
            $person = Person::with("familyPersons")->where("id", (int)$p->id)->first();
            if ($person) {

              // Person belongs to a family
              if ($person->familyPersons) {
                foreach ($person->familyPersons as $familyPerson) {
                  $familyPerson->delete();
                }
              }

              // Add person to this family
              FamilyPerson::create(["family_id" => $family->id, "person_id" => $person->id, "relation" => $p->relation]);
            }
          }
        }

        DB::commit();
        return $this->successResponse("Family updated successfully.");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while updating this family");
    }
    catch(ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this family");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $family = Family::with("familyPersons")->where("mask", $mask)->firstOrFail();
      $familyPersons = $family->familyPersons;

      if ($family->delete()) {
        foreach ($familyPersons as $familyPerson) {
          $familyPerson->delete();
        }
        return $this->successResponse("Family deleted successfully");
      }

      return $this->errorResponse("An error occurred while deleting this family");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this family");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
