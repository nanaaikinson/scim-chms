<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use App\Imports\GenericImport;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ContributionController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      /*$search = $request->input("search") ?: "";
      $perPage = $request->input("limit") ?: 1000;
      $orderColumn = $request->input("order_by") ?: "id";
      $orderDirection = $request->input("dir") ?: "DESC";

      $query = Contribution::select(
        "contributions.*",
        "people.mask as person_mask",
        DB::raw("CONCAT(people.first_name,' ',people.last_name) as person_name")
      )
        ->leftJoin("people", "people.id", "=", "contributions.person_id")
        ->orderBy("contributions.{$orderColumn}", $orderDirection);

      if ($search) {
        $query->where(function ($query) use ($search) {
          $query->where("person.first_name", "LIKE", "%" . $search . "%")
            ->orWhere("person.last_name", "LIKE", "%" . $search . "%");
        });
      }

      $query = $query->paginate($perPage);
      $options = $query->toArray();

      $contributions = $query->getCollection()->transform(function ($contribution, $key) {
        return [
          "mask" => (int)$contribution->mask,
          "date" => $contribution->date,
          "amount" => $contribution->amount,
          "method" => $contribution->method ? (ContributionMethodEnum::fromValue($contribution->method))->description : "",
          "created_at" => gmdate("Y-m-d", strtotime($contribution->created_at)),
          "type" => (ContributionTypeEnum::fromValue($contribution->type))->description,
          "person" => $contribution->person_name ? [
            "name" => $contribution->person_name,
            "mask" => $contribution->person_mask
          ] : ""
        ];
      });

      return $this->dataResponse([
        "items" => $contributions,
        "total" => $options["total"],
        "path" => $options["path"]
      ]);*/

      $contributions = [];
      Contribution::select(
        "contributions.*",
        "people.mask as person_mask",
        DB::raw("CONCAT(people.first_name,' ',people.last_name) as person_name")
      )
        ->leftJoin("people", "people.id", "=", "contributions.person_id")
        ->chunk(200, function ($records) use (&$contributions) {
          foreach ($records as $contribution) {
            $contributions[] = [
              "mask" => (int)$contribution->mask,
              "title" => (int)$contribution->name,
              "date" => $contribution->date,
              "amount" => $contribution->amount,
              "method" => $contribution->method ? (ContributionMethodEnum::fromValue($contribution->method))->description : "",
              "created_at" => gmdate("Y-m-d", strtotime($contribution->created_at)),
              "type" => $contribution->type !== 0 ? (ContributionTypeEnum::fromValue($contribution->type))->description : "general",
              "person" => $contribution->person_name ? [
                "name" => $contribution->person_name,
                "mask" => $contribution->person_mask
              ] : ""
            ];
          }
        });


      return $this->dataResponse([
        "items" => $contributions
      ]);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function getContributionFor($type)
  {
    switch ($type) {

    }
  }

  public function template()
  {
    try {
      $headers = ["CONTRIBUTION TYPE", "AMOUNT", "DATE", "METHOD OF PAYMENT", "PERSON ID", "GROUP ID", "PLEDGE ID", "FREQUENCY", "TITLE", "COMMENT"];
      $rows = [];

      $export = new GenericExport($rows, $headers);

      $filename = "contribution-import-template.xlsx";
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
            if (
              !$record[0] || !$record[1] || !$record[2] || !$record[3] ||
              !in_array($record[0], ContributionTypeEnum::getValues()) || !in_array($record[3], ContributionMethodEnum::getValues())
            ) {
              continue;
            }

            //
            $type = $record[0];
            $amount = $record[1];
            $method = $record[3];
            $person = $record[4];
            $group = $record[5];
            $pledge = $record[6];
            $frequency = $record[7];
            $title = $record[8];
            $comment = $record[9];

            $date = NULL;
            // XLS(X) extension
            if ($extension == "xlsx" || $extension == "xls") {
              $date = Carbon::instance(Date::excelToDateTimeObject($record[3]))->format("Y-m-d");
            }
            // CSV extension
            if ($extension == "csv") {
              $exploded = Str::contains($record[3], "/")
                ? explode("/", $record[3])
                : explode("-", $record[3]);

              if (strlen($exploded[0]) == 2) {
                $dateString = implode("-", array_reverse($exploded));
                $date = Carbon::parse($dateString)->format("Y-m-d");
              }

              if (strlen($exploded[0]) == 4) {
                $dateString = implode("-", $exploded);
                $date = Carbon::parse($dateString)->format("Y-m-d");
              }
            }

            $contribution = Contribution::create([
              "person_id" => $type !== ContributionTypeEnum::General ? (int)$type : NULL,
              "group_id" => $type == ContributionTypeEnum::Group ? (int)$group : NULL,
              "pledge_id" => $type == ContributionTypeEnum::Pledge ? (int)$pledge : NULL,
              "type" => $type,
              "frequency" => $type == ContributionTypeEnum::Tithe ? $frequency : NULL,
              "comment" => $comment,
              "date" => $date,
              "amount" => $amount,
              "mask" => generate_mask(),
              "method" => $method,
              "name" => $type == ContributionTypeEnum::General ? $title : NULL
            ]);

            if ($contribution) $saved += 1;
          }
          return $this->successResponse("Contribution import successful. {$saved} record(s) imported out of {$total}");
        }
        return $this->errorResponse("No data found to import");
      }
      return $this->errorResponse("File must be of type excel: xlsx, xls or csv");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
