<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ExpenseTypeEnum;
use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Imports\GenericImport;
use App\Models\Expense;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExpenseController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      $expenses = [];
      Expense::orderBy("id", "DESC")->chunk(200, function ($records) use (&$expenses) {
        foreach ($records as $expense) {
          $type = ExpenseTypeEnum::fromValue($expense->type);
          $expenses[] = [
            "id" => $expense->id,
            "mask" => $expense->mask,
            "date" => $expense->date,
            "name" => $expense->name,
            "amount" => $expense->amount,
            "comment" => $expense->comment,
            "type" => $type ? $type->description : NULL
          ];
        }
      });

      return $this->dataResponse($expenses);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(StoreExpenseRequest $request)
  {
    try {
      $validated = (object)$request->validationData();

      foreach ($validated->expenses as $expense) {
        $expense = (object)$expense;

        Expense::create([
          "name" => $expense->name,
          "type" => $expense->type ?: ExpenseTypeEnum::Utility,
          "amount" => $expense->amount,
          "comment" => $expense->comment ?: NULL,
          "date" => $expense->date ?: NULL,
          "mask" => generate_mask(),
        ]);
      }
      return $this->successResponse("Expense(s) recorded successfully.");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $expense = Expense::where("mask", $mask)->firstOrFail();

      return $this->dataResponse([
        "id" => $expense->id,
        "mask" => $expense->mask,
        "name" => $expense->name,
        "amount" => $expense->amount,
        "type" => $expense->type,
        "comment" => $expense->comment,
        "date" => $expense->date,
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this expense");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdateExpenseRequest $request, int $mask)
  {
    try {
      $expense = Expense::where("mask", $mask)->firstOrFail();
      $validated = (object)$request->validationData();

      $expense->name = $validated->name;
      $expense->type = $validated->type ?: ExpenseTypeEnum::Utility;
      $expense->comment = $validated->comment;
      $expense->amount = $validated->amount;
      $expense->date = $validated->date;

      if ($expense->save()) {
        return $this->successResponse("Expense updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this expense");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this expense");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $expense = Expense::where("mask", $mask)->firstOrFail();
      if ($expense->delete()) {
        return $this->successResponse("Expense deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this expense");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this expense");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function template()
  {
    try {
      $headers = ["NAME", "AMOUNT", "EXPENSE TYPE", "DATE", "COMMENT"];
      $rows = [];

      $export = new GenericExport($rows, $headers);

      $filename = "expense-import-template.xlsx";
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
      $rules = ["file" => "required"];
      $validator = Validator::make($request->all(), $rules);
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
            if (!$record[0] || !$record[1] || !$record[2] || !$record[3] || !in_array($record[2], ExpenseTypeEnum::getValues())) continue;

            // Format date field
            $name = $record[0];
            $amount = $record[1];
            $type = $record[2];
            $comment = $record[4];
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

            $expense = Expense::create([
              "name" => $name,
              "amount" => $amount,
              "type" => $type,
              "date" => $date,
              "comment" => $comment,
              "mask" => generate_mask()
            ]);

            if ($expense) $saved += 1;
          }
          return $this->successResponse("Expense import successful. {$saved} record(s) imported out of {$total}");
        }
        return $this->errorResponse("No data found to import");
      }
      return $this->errorResponse("File must be of type excel: xlsx, xls or csv");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
