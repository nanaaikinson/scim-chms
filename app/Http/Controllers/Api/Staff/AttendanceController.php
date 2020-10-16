<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\AttendanceTypeEnum;
use App\Enums\MemberStatusEnum;
use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use App\Imports\GenericImport;
use App\Models\Attendance;
use App\Models\AttendancePerson;
use App\Models\Group;
use App\Models\Person;
use App\Traits\ResponseTrait;
use BenSampo\Enum\Rules\EnumValue;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $attendances = Attendance::with("attendancePersons")->get()->map(function ($attendance) {
        $in = $attendance->attendancePersons->where("status", ST_PRESENT)->count();
        $out = $attendance->attendancePersons->where("status", ST_ABSENT)->count();

        return [
          "mask" => (int)$attendance->mask,
          "name" => $attendance->name,
          "type" => $attendance->type ? (AttendanceTypeEnum::fromValue($attendance->type))->description : "",
          "description" => $attendance->description,
          "in" => $in,
          "out" => $out,
        ];
      });

      return $this->dataResponse($attendances);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "name" => "required",
        "type" => "required",
        "date" => "required|date",
        "file" => "required"
      ];
      if ($request->type == AttendanceTypeEnum::Group) {
        $rules["group"] = "required|exists:groups,id";
      }

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }
      // Process data
      $extension = $request->file("file")->getClientOriginalExtension();
      if (is_valid_excel($extension)) {
        $data = Excel::toArray(new GenericImport(), $request->file("file"));
        if (isset($data) && count($data[0]) > 1) {
          DB::beginTransaction();

          $attendance = new Attendance();
          $attendance->name = $request->name;
          $attendance->description = $request->description;
          $attendance->date = $request->date;
          $attendance->type = $request->type ?: AttendanceTypeEnum::General;
          $attendance->group_id = $request->group ?: NULL;
          $attendance->mask = generate_mask();

          if ($attendance->save()) {
            foreach ($data[0] as $key => $person) {
              if ($key == 0) continue;
              AttendancePerson::create([
                "attendance_id" => $attendance->id,
                "person_id" => $person[1],
                "comment" => isset($person[8]) ? $person[8] : null,
                "status" => isset($person[7]) ? (strtolower($person[7]) == "in" ? ST_PRESENT : ST_ABSENT) : ST_ABSENT
              ]);
            }
            DB::commit();
            return $this->successResponse("Attendance saved successfully.");
          }
          DB::rollBack();
          return $this->errorResponse("An error occurred while saving this attendance");
        }
        return $this->errorResponse("No data found to import");
      }
      return $this->errorResponse("File must be of type excel: xlsx, xls or csv");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $heading = ["PID", "S/N", "NAME", "GENDER", "TELEPHONE", "MEMBERSHIP STATUS", "LOCATION", "STATUS", "COMMENT"];
      $attendance = Attendance::with("attendancePersons")->where("mask", $mask)->firstOrFail();
      $filename = "Attendance-{$attendance->mask}.csv";
      $rows = $attendance->attendancePersons->map(function ($att) {

        return [
          "mask" => $att->person->mask,
          "id" => $att->person->id,
          "name" => "{$att->person->first_name} {$att->person->last_name}",
          "gender" => $att->person->gender ? (strtolower($att->person->gender) == "male") ? "M" : "F" : "",
          "telephone" => $att->person->primary_telephone ? (string)$att->person->primary_telephone: "",
          "membershipStatus" => $att->person->member_status ? (MemberStatusEnum::fromValue($att->person->member_status))->description : "",
          "location" => $att->person->physical_address,
          "status" => $att->status == ST_PRESENT ? "in" : "out",
          "comment" => $att->comment
        ];
      });

      $export = new GenericExport($rows, $heading);
      Excel::store($export, $filename, "public");

      $file = Storage::disk("public")->get($filename);

      if ($file) {
        $base64 = "data:application/vnd.ms-excel;base64," . base64_encode($file);
        Storage::disk("public")->delete($filename);
        return $this->dataResponse([
          "attendance" => [
            "mask" => $attendance->mask,
            "name" => $attendance->name,
            "type" => $attendance->type,
            "group_id" => $attendance->group_id,
            "description" => $attendance->description,
            "date" => $attendance->date,
          ],
          "file" => [
            'url' => $base64,
            'filename' => $filename
          ]
        ]);
      }

      return $this->errorResponse('An error occurred while downloading this attendance');
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this attendance");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $attendance = Attendance::with("attendancePersons")->where("mask", $mask)->firstOrFail();
      $attendancePersons = $attendance->attendancePersons;

      $rules = [
        "name" => "required",
        "type" => ["required"],
        "date" => "required|date",
        "file" => "required"
      ];

      if ($request->type == AttendanceTypeEnum::Group) {
        $rules["group"] = "required|exists:groups,id";
      }
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }
      // Process data
      $extension = $request->file("file")->getClientOriginalExtension();
      if (is_valid_excel($extension)) {
        $data = Excel::toArray(new GenericImport(), $request->file("file"));
        if (isset($data) && count($data[0]) > 1) {
          DB::beginTransaction();

          $attendance->name = $request->name;
          $attendance->description = $request->description;
          $attendance->date = $request->date;
          $attendance->type = $request->type ?: AttendanceTypeEnum::General;
          $attendance->group_id = $request->group ?: NULL;

          if ($attendance->save()) {
            foreach ($attendancePersons as $att) {
              $att->delete();
            }
            foreach ($data[0] as $key => $person) {
              if ($key == 0) continue;
              AttendancePerson::create([
                "attendance_id" => $attendance->id,
                "person_id" => $person[1],
                "comment" => isset($person[8]) ? $person[8] : null,
                "status" => isset($person[7]) ? (strtolower($person[7]) == "in" ? ST_PRESENT : ST_ABSENT) : ST_ABSENT
              ]);
            }
            DB::commit();
            return $this->successResponse("Attendance updated successfully.");
          }
          DB::rollBack();
          return $this->errorResponse("An error occurred while saving this attendance");
        }
        return $this->errorResponse("No data found to import");
      }
      return $this->errorResponse("File must be of type excel: xlsx, xls or csv");

    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this attendance");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $attendance = Attendance::with("attendancePersons")->where("mask", $mask)->firstOrFail();
      $attendancePersons = $attendance->attendancePersons;

      if ($attendance->delete()) {
        foreach ($attendancePersons as $person) {
          $person->delete();
        }

        return $this->successResponse("Attendance deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this attendance");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this attendance");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function template(Request $request)
  {
    $rules = [
      "type" => "required",
      "group_id" => "required_if:type,==," . AttendanceTypeEnum::Group
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) return $this->validationResponse($validator->errors());

    if ($request->type == AttendanceTypeEnum::Group) {
      return $this->groupAttendanceTemplate($request->group_id);
    }
    return $this->generalAttendanceTemplate();
  }

  public function download(Request $request, int $mask)
  {
    try {
      // TODO: Fetch data based on request->type

      $attendance = Attendance::with("attendancePersons")->where("mask", $mask)->firstOrFail();
      $filename = "Attendance-{$attendance->date}.xlsx";
      $headers = ["FIRST NAME", "LAST NAME", "TELEPHONE", "LOCATION", "STATUS", "COMMENT"];
      $rows = $attendance->attendancePersons->map(function ($att) {
        return [
          "first_name" => $att->person->first_name,
          "last_name" => $att->person->last_name,
          "telephone" => $att->person->primary_telephone ? (string)$att->person->primary_telephone : '',
          "location" => $att->person->physical_address,
          "status" => $att->status == ST_PRESENT ? "In" : "Out",
          "comment" => $att->comment
        ];
      });

      $export = new GenericExport($rows, $headers);
      Excel::store($export, $filename, "public");

      $file = Storage::disk("public")->get($filename);

      if ($file) {
        $base64 = "data:application/vnd.ms-excel;base64," . base64_encode($file);
        Storage::disk("public")->delete($filename);
        return $this->dataResponse(['url' => $base64, 'filename' => $filename]);
      }
      return $this->errorResponse('An error occurred while downloading this attendance');

    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this attendance");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function generalAttendanceTemplate()
  {
    try {
      $heading = ["PID", "S/N", "NAME", "GENDER", "TELEPHONE", "MEMBERSHIP STATUS", "LOCATION", "STATUS", "COMMENT"];
      $persons = Person::all()
        ->map(function ($person) {
          return [
            "mask" => $person->mask,
            "id" => $person->id,
            "name" => "{$person->first_name} {$person->last_name}",
            "gender" => $person->gender ? (strtolower($person->gender) == "male") ? "M" : "F" : "",
            "telephone" => (string)$person->primary_telephone,
            "membershipStatus" => $person->member_status ? (MemberStatusEnum::fromValue($person->member_status))->description : "",
            "location" => $person->physical_address,
            "status" => "in",
            "comment" => ""
          ];
        });

      $export = new GenericExport($persons, $heading);
      $filename = "attendance-template.xlsx";
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

  public function groupAttendanceTemplate(int $group_id)
  {
    try {
      $heading = ["PID", "S/N", "NAME", "GENDER", "TELEPHONE", "MEMBERSHIP STATUS", "LOCATION", "STATUS", "COMMENT"];
      $group = Group::with("persons")->find($group_id);
      $persons = $group->persons->map(function ($person) {
        return [
          "mask" => $person->mask,
          "id" => $person->id,
          "name" => "{$person->first_name} {$person->last_name}",
          "gender" => $person->gender ? (strtolower($person->gender) == "male") ? "M" : "F" : "",
          "telephone" => $person->primary_telephone,
          "membershipStatus" => $person->member_status ? (MemberStatusEnum::fromValue($person->member_status))->description : "",
          "location" => $person->physical_address,
          "status" => "in",
          "comment" => ""
        ];
      });

      $export = new GenericExport($persons, $heading);

      $filename = "attendance-template.xlsx";
      Excel::store($export, $filename, "public");

      $file = Storage::disk("public")->get($filename);

      if ($file) {
        $base64 = "data:application/vnd.ms-excel;base64," . base64_encode($file);
        Storage::disk("public")->delete($filename);
        return $this->dataResponse(['url' => $base64, 'filename' => $filename]);
      }
      return $this->errorResponse('An error occurred while exporting the requested list');
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
