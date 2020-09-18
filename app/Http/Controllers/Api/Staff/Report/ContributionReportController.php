<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Enums\ReportDurationEnum;
use App\Enums\ReportReturnTypeEnum;
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

      $data = $query->get();
      return $this->reportType($data, $reportType, $duration, $from, $to, $date);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function accumulationType($data)
  {
    $total = 0;
    $items = $data->map(function($record) use (&$total) {
      $total += $record->amount;
      if ($record->type == 4) dd($record->group_id);
      //$for = "";
      $group = $record->group ? $record->group->name : "";
      $pledge = $record->pledge ? $record->pledge->name : "";
      $person = $record->person ? "{$record->person->first_name} {$record->person->last_name}" : "";

      return [
        //"for" => $for,
        "amount" => $record->amount,
        "date" => $record->date,
        "frequency" => $record->frequency,
        "group" => $group,
        "pledge" => $pledge,
        "person" => $person,
        "contribution_type" => (ContributionTypeEnum::fromValue($record->type))->description,
        "method" => (ContributionMethodEnum::fromValue($record->method))->description
      ];
    });

    return ["total" => round($total, 2), "results" => $items];
  }

  public function chartType($data, $duration, $from, $to, $date)
  {

  }

  public function reportType($data, $type, $duration = null, $from = null, $to = null, $date = null)
  {
    switch ((int)$type) {
      case ReportReturnTypeEnum::Chart:
        return $this->chartType($data, $duration, $from, $to, $date);

      default:
        return $this->accumulationType($data);
    }
  }
}
