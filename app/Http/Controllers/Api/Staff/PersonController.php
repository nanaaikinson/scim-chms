<?php

namespace App\Http\Controllers\Api\Staff;

use App\Classes\FileManagerTenancy;
use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Enums\FollowUpEnum;
use App\Enums\MemberStatusEnum;
use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use App\Imports\GenericImport;
use App\Models\AttendancePerson;
use App\Models\Family;
use App\Models\FamilyPerson;
use App\Models\GroupPerson;
use App\Models\Person;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PersonController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    // TODO: Refactor FileManagerTenancy
    try {
      $people = [];
      Person::with("familyPersons")->with("avatar")
        ->chunk(200, function ($records) use (&$people) {
          foreach ($records as $person) {
            $familyRelation = count($person->familyPersons) > 0 ? $person->familyPersons[0]->relation : "";
            $avatar = $person->avatar ? url("/") . $person->avatar->url : "";

            $people[] = [
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
          }
        });

      return $this->dataResponse($people);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    // TODO: Manipulate and transform image upload
    try {
      $rules = [
        "first_name" => "required",
        "last_name" => "required",
        "date_of_birth" => "nullable|date",
        "baptism_date" => "nullable|date",
        "join_date" => "nullable|date",
        "gender" => "nullable|in:male,female,Male,Female",
        "groups.*" => "nullable|exists:groups,id",
        "avatar" => "nullable|mimes:jpg,jpeg,png|max:2048"
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      // Process data
      DB::beginTransaction();
      $avatar = null;

      $nameSlug = "{$request->first_name} {$request->middle_name} {$request->last_name}";
      $nameSlug = Str::slug($nameSlug);

      $person = new Person();
      $person->first_name = $request->first_name;
      $person->last_name = $request->last_name;
      $person->middle_name = $request->middle_name;
      $person->email = $request->email ?: NULL;
      $person->date_of_birth = $request->date_of_birth ?: NULL;
      $person->gender = $request->gender ?: NULL;
      $person->grade = $request->grade ?: NULL;
      $person->marital_status = $request->marital_status ?: NULL;
      $person->baptism_date = $request->baptism_date ?: NULL;
      $person->join_date = $request->join_date ?: NULL;
      $person->employer = $request->employer ?: NULL;
      $person->occupation = $request->occupation ?: NULL;
      $person->primary_telephone = $request->primary_telephone ?: NULL;
      $person->secondary_telephone = $request->secondary_telephone ?: NULL;
      $person->postal_address = $request->postal_address ?: NULL;
      $person->physical_address = $request->physical_address ?: NULL;
      $person->tithe_number = $request->tithe_number ?: NULL;
      $person->next_of_kin_name = $request->next_of_kin_name ?: NULL;
      $person->next_of_kin_telephone = $request->next_of_kin_telephone ?: NULL;
      $person->emergency_telephone = $request->emergency_telephone ?: NULL;
      $person->member_status = $request->member_status ?: ST_MEMBER;
      $person->mask = generate_mask();

      if ($request->hasFile("avatar")) {
        $file = $request->file("avatar");
        $avatar = FileManagerTenancy::uploadFile($file, "people", $nameSlug, "tenancy");
      }

      if ($person->save()) {
        if (!is_null($avatar)) {
          $person->avatar()->create([
            "url" => $avatar->url,
            "filename" => $avatar->path,
            "mask" => generate_mask(),
            "public_id" => isset($avatar->public_id) ? $avatar->public_id : NULL
          ]);
        }
        // Groups
        if ($request->groups) {
          foreach ($request->groups as $group) {
            GroupPerson::create(["group_id" => $group, "person_id" => $person->id]);
          }
        }

        // Family
        if ($request->family) {
          if ($request->family > 0) {
            FamilyPerson::create(["family_id" => $request->family, "person_id" => $person->id, "relation" => $request->relation]);
          } else {
            $fam = Family::create(["name" => $person->last_name, "mask" => generate_mask()]);
            FamilyPerson::create(["family_id" => $fam->id, "person_id" => $person->id, "relation" => $request->relation]);
          }
        }

        DB::commit();
        return $this->successResponse("Person created successfully");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $person = Person::with("groups")->with("familyPersons")
        ->with("avatar")
        ->where("mask", $mask)->firstOrFail();

      $groups = $person->groups ? $person->groups->map(function ($group) {
        return (int)$group->id;
      }) : [];

      $family = $person->familyPersons->isNotEmpty() ? [
        "id" => $person->familyPersons[0]->family_id,
        "relation" => $person->familyPersons[0]->relation
      ] : null;

      return $this->dataResponse([
        "mask" => $person->mask,
        "first_name" => $person->first_name,
        "last_name" => $person->last_name,
        "email" => $person->email ?: "",
        "primary_telephone" => $person->primary_telephone ?: "",
        "secondary_telephone" => $person->secondary_telephone ?: "",
        "middle_name" => $person->middle_name ?: "",
        "gender" => $person->gender ?: "",
        "grade" => $person->grade ?: "",
        "marital_status" => $person->marital_status ?: "",
        "date_of_birth" => $person->date_of_birth ?: "",
        "baptism_date" => $person->baptism_date ?: "",
        "join_date" => $person->join_date ?: "",
        "employer" => $person->employer ?: "",
        "occupation" => $person->occupation ?: "",
        "postal_address" => $person->postal_address ?: "",
        "physical_address" => $person->physical_address ?: "",
        "tithe_number" => $person->tithe_number ?: "",
        "next_of_kin_name" => $person->next_of_kin_name ?: "",
        "next_of_kin_telephone" => $person->next_of_kin_telephone ?: "",
        "emergency_telephone" => $person->emergency_telephone ?: "",
        "groups" => $groups,
        "family" => $family,
        "member_status" => $person->member_status ?: "",
        "avatar" => $person->avatar ? url("/") . $person->avatar->url : ""
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $person = Person::with("avatar")
        ->with("groupPersons")->with("familyPersons")
        ->where("mask", $mask)->firstOrFail();

      $image = $person->avatar;
      $groupPersons = $person->groupPersons;
      $familyPersons = $person->familyPersons;

      $rules = [
        "first_name" => "required",
        "last_name" => "required",
        "date_of_birth" => "nullable|date",
        "baptism_date" => "nullable|date",
        "join_date" => "nullable|date",
        "gender" => "nullable|in:male,female,Male,Female",
        "groups.*" => "nullable|exists:groups,id"
      ];
      if ($request->hasFile("avatar")) {
        $rules["avatar"] = "mimes:jpg,jpeg,png|max:2048";
      }
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      // Process data
      DB::beginTransaction();
      $avatar = NULL;

      $nameSlug = "{$request->first_name} {$request->middle_name} {$request->last_name}";
      $nameSlug = Str::slug($nameSlug);

      $person->first_name = $request->first_name;
      $person->last_name = $request->last_name;
      $person->middle_name = $request->middle_name;
      $person->email = $request->email ?: NULL;
      $person->date_of_birth = $request->date_of_birth ?: NULL;
      $person->gender = $request->gender ?: NULL;
      $person->grade = $request->grade ?: NULL;
      $person->marital_status = $request->marital_status ?: NULL;
      $person->baptism_date = $request->baptism_date ?: NULL;
      $person->join_date = $request->join_date ?: NULL;
      $person->employer = $request->employer ?: NULL;
      $person->occupation = $request->occupation ?: NULL;
      $person->primary_telephone = $request->primary_telephone ?: NULL;
      $person->secondary_telephone = $request->secondary_telephone ?: NULL;
      $person->postal_address = $request->postal_address ?: NULL;
      $person->physical_address = $request->physical_address ?: NULL;
      $person->tithe_number = $request->tithe_number ?: NULL;
      $person->member_status = $request->member_status ?: ST_MEMBER;
      $person->next_of_kin_name = $request->next_of_kin_name ?: NULL;
      $person->next_of_kin_telephone = $request->next_of_kin_telephone ?: NULL;
      $person->emergency_telephone = $request->emergency_telephone ?: NULL;

      if ($request->hasFile("avatar")) {
        $file = $request->file("avatar");
        $avatar = FileManagerTenancy::uploadFile($file, "people", $nameSlug, "tenancy");
      }

      if ($person->save()) {
        // Avatar
        if (!is_null($avatar)) {
          $person->avatar()->create([
            "url" => $avatar->url,
            "filename" => $avatar->path,
            "mask" => generate_mask(),
            "public_id" => isset($avatar->public_id) ? $avatar->public_id : NULL
          ]);

          if ($image) {
            FileManagerTenancy::deleteFile($image->filename, "tenancy");
            $image->delete();
          }
        }

        // Groups
        if ($request->groups) {
          foreach ($groupPersons as $groupPerson) {
            $groupPerson->delete();
          }

          foreach ($request->groups as $group) {
            GroupPerson::create(["group_id" => $group, "person_id" => $person->id]);
          }
        }

        // Family
        if ($request->family) {
          foreach ($familyPersons as $familyPerson) {
            $familyPerson->delete();
          }

          if ($request->family > 0) {
            FamilyPerson::create(["family_id" => $request->family, "person_id" => $person->id, "relation" => $request->relation]);
          } else {
            $fam = Family::create(["name" => $person->last_name, "mask" => generate_mask()]);
            FamilyPerson::create(["family_id" => $fam->id, "person_id" => $person->id, "relation" => $request->relation]);
          }
        }

        DB::commit();
        return $this->successResponse("Person updated successfully");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while updating this person");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $person = Person::with("familyPersons")->with("groupPersons")->with("attendancePersons")
        ->with("followUps")->with("avatar")->with("contributions")
        ->where("mask", $mask)->firstOrFail();

      DB::beginTransaction();
      if ($person->delete()) {
        $person->familyPersons->each(function ($record) {
          $record->delete();
        });
        $person->groupPersons->each(function ($record) {
          $record->delete();
        });
        $person->attendancePersons->each(function ($record) {
          $record->delete();
        });
        $person->followUps->each(function ($record) {
          $record->delete();
        });
        $person->contributions->each(function ($record) {
          $record->delete();
        });

        DB::commit();
        return $this->successResponse("Person deleted successfully");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while deleting this person");
    } catch (ModelNotFoundException $e) {
      return $this->errorResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function members()
  {
    $members = Person::select("id", DB::raw('CONCAT(first_name, " ", last_name) AS name'))
      ->with("avatar")
      ->get()->map(function ($person) {
        $avatar = $person->avatar ? url("/") . $person->avatar->url : "";
        return [
          "id" => $person->id,
          "name" => $person->name,
          "avatar" => $person->avatar,
        ];
      });

    return $this->dataResponse($members);
  }

  public function details(int $mask)
  {
    try {
      $person = Person::with("groups")->with("familyPersons")
        ->with("avatar")
        ->where("mask", $mask)->firstOrFail();

      $groups = $person->groups ? $person->groups->map(function ($group) {
        return [
          "name" => $group->name,
          "mask" => (int)$group->mask
        ];
      }) : [];

      $familyId = $person->familyPersons->isNotEmpty() ? $person->familyPersons[0]->family_id : null;
      $familyMembers = [];

      if ($familyId) {
        $familyMembers = FamilyPerson::with("person")->where("family_id", $familyId)
          ->where("person_id", "<>", $person->id)
          ->get()
          ->map(function ($familyPerson) {
            return [
              "name" => "{$familyPerson->person->first_name} {$familyPerson->person->last_name}",
              "relation" => $familyPerson->relation,
              "mask" => $familyPerson->person->mask,
              "avatar" => $familyPerson->person->avatar ? url("/") . $familyPerson->person->avatar->url : "",
            ];
          });
      }

      return $this->dataResponse([
        "mask" => $person->mask,
        "first_name" => $person->first_name,
        "last_name" => $person->last_name,
        "email" => $person->email ?: "",
        "primary_telephone" => $person->primary_telephone ?: "",
        "secondary_telephone" => $person->secondary_telephone ?: "",
        "middle_name" => $person->middle_name ?: "",
        "gender" => $person->gender ?: "",
        "grade" => $person->grade ?: "",
        "marital_status" => $person->marital_status ?: "",
        "date_of_birth" => $person->date_of_birth ?: "",
        "baptism_date" => $person->baptism_date ?: "",
        "join_date" => $person->join_date ?: "",
        "employer" => $person->employer ?: "",
        "occupation" => $person->occupation ?: "",
        "postal_address" => $person->postal_address ?: "",
        "physical_address" => $person->physical_address ?: "",
        "tithe_number" => $person->tithe_number ?: "",
        "groups" => $groups,
        "family" => $familyMembers,
        "member_status" => $person->member_status ? (MemberStatusEnum::fromValue($person->member_status))->description : "",
        "avatar" => $person->avatar ? url("/") . $person->avatar->url : "",
        "age" => $person->date_of_birth ? Carbon::now()->diffInYears(Carbon::parse($person->date_of_birth)) : "",
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function attendance(Request $request, int $mask)
  {
    try {
      $startDate = $request->input("start_date") ?: NULL;
      $endDate = $request->input("end_date") ?: NULL;

      $person = Person::select("id")->where("mask", $mask)->firstOrFail();
      $query = AttendancePerson::select("attendance_people.status", "attendance_people.comment", "attendances.*")
        ->leftJoin("attendances", "attendances.id", "=", "attendance_people.attendance_id")
        ->where("attendance_people.person_id", $person->id);

      if ($startDate && $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
          $query->whereBetween("attendances.date", [$startDate, $endDate]);
        });
      }

      $results = $query->get();
      $attendances = $results->map(function ($att) {
        return [
          "date" => $att->date,
          "status" => $att->status == ST_PRESENT ? "In" : "Out",
          "comment" => $att->comment,
          "name" => $att->name
        ];
      });

      return $this->dataResponse($attendances);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function followUp(Request $request, int $mask)
  {
    try {
      $startDate = $request->input("start_date") ?: NULL;
      $endDate = $request->input("end_date") ?: NULL;

      $person = Person::select("id")->with("followUps")->where("mask", $mask)->firstOrFail();
      $query = $person->followUps();

      if ($startDate && $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
          $query->whereBetween("date", [$startDate, $endDate]);
        });
      }

      $results = $query->get();
      $followUps = $results->map(function ($followUp) {
        return [
          "assigned_to" => "{$followUp->user->first_name} {$followUp->user->last_name}",
          "date" => $followUp->date,
          "type" => (FollowUpEnum::fromValue($followUp->type))->description,
          "completed" => $followUp->completed == ST_TRUE ? "Done" : "Pending",
          "completion_date" => $followUp->completion_date,
          "comment" => $followUp->comment,
        ];
      });

      return $this->dataResponse($followUps);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function contributions(Request $request, int $mask)
  {
    try {
      $startDate = $request->input("start_date") ?: NULL;
      $endDate = $request->input("end_date") ?: NULL;

      $person = Person::select("id")->with("contributions")->where("mask", $mask)->firstOrFail();
      $query = $person->contributions();

      if ($startDate && $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
          $query->whereBetween("date", [$startDate, $endDate]);
        });
      }

      $results = $query->get();

      $contributions = $results->map(function ($record) {
        $group = $record->group ? $record->group->name : NULL;
        $pledge = $record->pledge ? $record->pledge->name : NULL;

        return [
          "amount" => $record->amount,
          "mask" => $record->mask,
          "date" => $record->date,
          "group" => $group,
          "type" => (ContributionTypeEnum::fromValue($record->type))->description,
          "method" => (ContributionMethodEnum::fromValue($record->method))->description,
          "pledge" => $pledge,
          "comment" => $record->comment
        ];
      });

      return $this->dataResponse($contributions);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this person");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function template()
  {
    try {
      $heading = [
        "FIRST NAME", "LAST NAME", "EMAIL", "DATE OF BIRTH", "GENDER", "MARITAL STATUS",
        "PRIMARY TELEPHONE", "POSTAL ADDRESS", "PHYSICAL ADDRESS",
        "TITHE NUMBER", "MEMBERSHIP STATUS"
      ];

      $export = new GenericExport([], $heading);

      $filename = "people-import-template.xlsx";
      Excel::store($export, $filename, "public");

      $file = Storage::disk("public")->get($filename);

      if ($file) {
        $base64 = "data:application/vnd.ms-excel;base64," . base64_encode($file);
        Storage::disk("public")->delete($filename);
        return $this->dataResponse(['url' => $base64, 'filename' => $filename]);
      }
      return $this->errorResponse('An error occurred while exporting the requested list');
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function import(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), ["file" => "required"]);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }
      // Process data
      $extension = $request->file("file")->getClientOriginalExtension();
      if (is_valid_excel($extension)) {
        $data = Excel::toArray(new GenericImport(), $request->file("file"));

        if (isset($data) && count($data[0]) > 1) {
          $total = count($data[0]) - 1;
          $saved = 0;

          foreach ($data[0] as $key => $record) {
            if ($key == 0) continue;

            $firstName = $record[0] ?: NULL;
            $lastName = $record[1] ?: NULL;
            $email = $record[2] ?: NULL;
            $dob = $record[3] ?: NULL;
            $gender = $record[4] ? (strtolower($record[4]) == "female") ? "Female" : "Male" : "Male";
            $maritalStatus = $record[5] ? strtolower($record[5]) : NULL;
            $primaryTelephone = $record[6] ?:  NULL;
            $postalAddress = $record[7] ?:  NULL;
            $physicalAddress = $record[8] ?:  NULL;
            $titheNumber = $record[9] ?:  NULL;
            $membershipStatus = $record[10] ?:  NULL;

            if (!trim($firstName) && !trim($lastName)) continue;

            // XLS(X) extension
            if ($extension == "xlsx" || $extension == "xls") {
              $dob = Carbon::instance(Date::excelToDateTimeObject($record[3]))->format("Y-m-d");
            }
            // CSV extension
            if ($extension == "csv") {
              $exploded = Str::contains($record[3], "/")
                ? explode("/", $record[3])
                : explode("-", $record[3]);

              if (strlen($exploded[0]) == 2) {
                $dateString = implode("-", array_reverse($exploded));
                $dob = Carbon::parse($dateString)->format("Y-m-d");
              }

              if (strlen($exploded[0]) == 4) {
                $dateString = implode("-", $exploded);
                $dob = Carbon::parse($dateString)->format("Y-m-d");
              }
            }

            $person = Person::create([
              "first_name" => $firstName,
              "last_name" => $lastName,
              "email" => $email,
              "date_of_birth" => $dob,
              "gender" => $gender,
              "marital_status" => $maritalStatus,
              "primary_telephone" => $primaryTelephone,
              "postal_address" => $postalAddress,
              "physical_address" => $physicalAddress,
              "tithe_number" => $titheNumber,
              "member_status" => $membershipStatus,
              "mask" => generate_mask()
            ]);

            if ($person) $saved += 1;
          }

          return $this->successResponse("People import successful. {$saved} record(s) imported out of {$total}");
        }
        return $this->errorResponse("No data found to import");
      }
      return $this->errorResponse("File must be of type excel: xlsx, xls or csv");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
