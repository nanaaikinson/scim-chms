<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Classes\FileManagerTenancy;
use App\Http\Controllers\Controller;
use App\Models\PastorReport;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PastorReportController extends Controller
{
  use ResponseTrait;

  public function index(Request $request): JsonResponse
  {
    $reports = PastorReport::where('tenant', tenant('id'))->get()->map(function ($report) {
      $downloadLink = config("app.url") . "/pastors-report/download/{$report->id}";

      return [
        "id" => $report->id,
        "tenant" => ucfirst($report->tenant),
        "user" => $report->user,
        "type" => ucfirst($report->type),
        "title" => $report->title,
        "date" => $report->type == "monthly" ? date("F Y", strtotime($report->date)) : date("Y", strtotime($report->date)),
        "download_link" => $downloadLink,
        "file_url" => Storage::disk("central")->url($report->filepath),
        "created_at" => $report->created_at,
      ];
    });

    return $this->dataResponse($reports);
  }

  public function store(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "file" => "required|mimes:pdf",
        "type" => "required|in:monthly,yearly",
        "date" => "required|date|date_format:Y-m-d",
      ]);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      DB::beginTransaction();
      $report = PastorReport::create([
        "tenant" => tenant('id'),
        "user" => $request->user()->name,
        "title" => $request->input("title"),
        "type" => $request->input("type"),
        "date" => $request->input("date"),
      ]);

      if ($report) {
        if ($request->hasFile("file")) {
          $file = FileManagerTenancy::uploadFile($request->file("file"), "reports", null, "central");
          $report->update([
            "url" => $file->url,
            "filename" => $file->path,
            "filepath" => $file->path,
          ]);
        }

        DB::commit();
        return $this->successResponse("Report uploaded successfully.");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while uploading this report");
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy($id): JsonResponse
  {
    try {
      $report = PastorReport::findOrFail($id);
      $report->delete();
      FileManagerTenancy::deleteFile($report->filepath, "central");

      return $this->successResponse("Report deleted successfully.");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function downloadReport($id)
  {
    try {
      $report = PastorReport::findOrFail($id);

      $file = Storage::disk("central")->get($report->filepath);
      return response()->download($file);
    }
    catch (ModelNotFoundException $e) {
      return "";
    }
    catch (\Exception $e) {
      return "";
    }
  }
}
