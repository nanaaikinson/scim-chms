<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Enums\ContributionTypeEnum;
use App\Enums\ReportDurationEnum;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionReportController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      $date = $request->input("date");
      $from = $request->input("from");
      $to = $request->input("to");
      $duration = (int)$request->input("duration");
      $contributionType = $request->input("contribution_type");
      $pledge = $request->input("pledge");
      $groupId = $request->input("group_id");
      $reportType = (int)$request->input("report_type");
      $paymentMethod = $request->input("payment_method");

      $query = Contribution::with("person")->with("group")->with("pledge");
      // Duration
      $query->where(function ($query) use ($duration, $to, $from, $date) {
        // Day
        if ($duration == ReportDurationEnum::Day) {
          $query->whereDate("date", $date);
        }
        // Week
        if ($duration == ReportDurationEnum::Week) {
          $week = Carbon::parse($date)->weekOfYear;
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear("date", $year)->where(DB::raw("WEEKOFYEAR(date)"), $week);
        }
        // Month
        if ($duration == ReportDurationEnum::Month) {
          $month = Carbon::parse($date)->format("m");
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear("date", $year)->whereMonth("date", $month);
        }
        // Year
        if ($duration == ReportDurationEnum::Year) {
          $query->whereYear("date", $date);
        }
        // Specific period
        if ($duration == ReportDurationEnum::Period) {
          $query->whereBetween("date", [$from, $to]);
        }
      });
      // Contribution type
      $query->where(function ($query) use ($groupId, $pledge, $contributionType) {
        if ($contributionType !== "all") {
          $query->where("type", $contributionType);

          if ($contributionType == ContributionTypeEnum::Pledge) {
            $query->where("type_id", $pledge);
          }
          if ($contributionType == ContributionTypeEnum::Group) {
            $query->where("type_id", $groupId);
          }
        }
      });
      // Payment method
      $query->where(function ($query) use ($paymentMethod) {
        if ($paymentMethod !== "all") {
          $query->where("method", $paymentMethod);
        }
      });

      return $query->toSql();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function accumulationType()
  {

  }

  public function chartType()
  {

  }

  public function reportType($results, $type, $duration = null, $from = null, $to = null)
  {

  }
}
