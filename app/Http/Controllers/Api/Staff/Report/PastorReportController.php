<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Classes\FileManagerTenancy;
use App\Http\Controllers\Controller;
use App\Models\PastorReport;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PastorReportController extends Controller
{
  use ResponseTrait;

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
        "tenant" => "",
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
}
