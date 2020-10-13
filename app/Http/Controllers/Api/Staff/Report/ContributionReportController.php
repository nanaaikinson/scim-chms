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
      $filterByCreatedAt = $request->input("filter_by_created_at") ? true : NULL;
      $date = $request->input("date");
      $from = $request->input("from");
      $to = $request->input("to");
      $duration = (int)$request->input("duration");
      $contributionType = $request->input("contribution_type");
      $pledgeId = $request->input("pledge_id") ?: NULL;
      $groupId = $request->input("group_id") ?: NULL;
      $reportType = (int)$request->input("report_type");
      $paymentMethod = $request->input("payment_method");

      $query = Contribution::with("person")->with("group")->with("pledge");
      $filterDateColumn = $filterByCreatedAt ? "created_at" : "date";

      // Duration
      $query->where(function ($query) use ($filterDateColumn, $duration, $to, $from, $date) {
        // Day
        if ($duration == ReportDurationEnum::Day) {
          $query->whereDate($filterDateColumn, $date);
        }
        // Week
        if ($duration == ReportDurationEnum::Week) {
          $week = Carbon::parse($date)->weekOfYear;
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear($filterDateColumn, $year)->where(DB::raw("WEEKOFYEAR(date)"), $week);
        }
        // Month
        if ($duration == ReportDurationEnum::Month) {
          $month = Carbon::parse($date)->format("m");
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear($filterDateColumn, $year)->whereMonth($filterDateColumn, $month);
        }
        // Year
        if ($duration == ReportDurationEnum::Year) {
          $query->whereYear($filterDateColumn, $date);
        }
        // Specific period
        if ($duration == ReportDurationEnum::Period) {
          $query->whereBetween($filterDateColumn, [$from, $to]);
        }
      });

      // Contribution type
      $query->where(function ($query) use ($groupId, $pledgeId, $contributionType) {
        if ($contributionType !== "all") {
          $query->where("type", $contributionType);

          if ($contributionType == ContributionTypeEnum::Pledge) {
            $query->where("pledge_id", $pledgeId);
          }
          if ($contributionType == ContributionTypeEnum::Group) {
            $query->where("group_id", $groupId);
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
      return $this->reportType($data, $reportType, $filterByCreatedAt, $duration, $from, $to, $date);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function accumulationType($data, $filterByCreatedAt)
  {
    $total = 0;
     $chart_type = "Table";
    $items = $data->map(function($record) use ($filterByCreatedAt, &$total) {
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
        "created_at" => $record->created_at,
        "frequency" => $record->frequency,
        "group" => $group,
        "pledge" => $pledge,
        "person" => $person,
        "filter_by_created_at" => $filterByCreatedAt ? true : false,
        "contribution_type" => (ContributionTypeEnum::fromValue($record->type))->description,
        "method" => (ContributionMethodEnum::fromValue($record->method))->description
      ];
    });

    return ["total" => round($total, 2), "results" => $items, "chart_type"=> $chart_type];
  }

  public function chartType($data, $filterByCreatedAt, $duration = null, $from = null, $to = null, $date = null)
  {
    $results = [];
    $chartType = "";

    // Specific period
    if ($duration == ReportDurationEnum::Period) {
      $from = Carbon::parse($from);
      $to = Carbon::parse($to);
      $dateDiffInYears = $to->diffInYears($from);

      // Single year
      if ($dateDiffInYears == 0) {
        $chartType = "bar chart";

        $start = (int)$from->format("m");
        $end = (int)$to->format("m");

        for ($i = $start; $i <= $end; $i++) {
          // Set month data
          $monthData = ["name" => get_month_name($i), "total" => 0];

          // Loop through data
          foreach ($data as $d) {
            $dataMonth = (int)date("m", strtotime($filterByCreatedAt ? $d->created_at : $d->date));
            if ($dataMonth !== $i) continue;

            $monthData["total"] += $d->amount;
          }

          $results[] = $monthData;
        }
      }

      // Year on year
      if ($dateDiffInYears > 0) {
        $chartType = "multiple bar charts";

        $startYear = (int)$from->format("Y");
        $endYear = (int)$to->format("Y");
        $startMonth = (int)$from->format("m");
        $endMonth = (int)$to->format("m");

        for ($year = $startYear; $year <= $endYear; $year++) {
          $yearData = [];

          for ($i = 1; $i <= 12; $i++) {
            // Skip loop if month is less than starting month for start year
            if ($year == $startYear && $i < $startMonth) continue;

            // Skip loop if month is greater than ending month for end year
            if ($year == $endYear && $i > $endMonth) continue;

            $monthData = ["name" => get_month_name($i), "total" => 0];

            // Loop through data
            foreach ($data as $d) {
              $dataMonth = (int)Carbon::parse($d->date)->format("m");
              $dataYear = (int)Carbon::parse($d->date)->format("Y");

              if ($dataYear == $year && $dataMonth == $i) {
                $monthData["total"] += $d->amount;
              }
            }

            $yearData[] = $monthData;
          }

          $results[$year] = $yearData;
        }
      }
    }

    // Year
    elseif ($duration == ReportDurationEnum::Year) {
      $chartType = "bar chart";
      $start = 1;
      $end = 12;

      for ($i = $start; $i <= $end; $i++) {
        // Set month data
        $monthData = ["name" => get_month_name($i), "total" => 0];

        // Loop through data
        foreach ($data as $d) {
          $dataMonth = (int)date("m", strtotime($filterByCreatedAt ? $d->created_at : $d->date));
          if ($dataMonth !== $i) continue;

          $monthData["total"] += $d->amount;
        }

        $results[] = $monthData;
      }
    }

    // Month
    elseif ($duration == ReportDurationEnum::Month) {
      $chartType = "bar chart";
      $weeks = weeks_in_month(Carbon::parse($date)->month, Carbon::parse($date)->year);

      for ($i = 1; $i <= $weeks; $i++) {
        $weekData = ["name" => "Week {$i}", "total" => 0];

        foreach ($data as $d) {
          $dataWeek = Carbon::parse($filterByCreatedAt ? $d->created_at : $d->date)->weekNumberInMonth;

          if ($dataWeek == $i) {
            $weekData["total"] += $d->amount;
          }
        }
        $results[] = $weekData;
      }
    }

    // Week
    elseif ($duration == ReportDurationEnum::Week) {
      $chartType = "bar chart";
      $startDay = 0;
      $endDay= 6;

      for ($i = $startDay; $i <= $endDay; $i++) {
        $dayData = ["name" => get_day_name($i), "total" => 0];

        foreach ($data as $d) {
          $dataDay = Carbon::parse($filterByCreatedAt ? $d->created_at : $d->date)->dayOfWeek;

          if ($dataDay == $i) {
            $dayData["total"] += $d->amount;
          }
        }

        $results[] = $dayData;
      }
    }

    // Day
    else {
      $results = $this->accumulationType($data, $filterByCreatedAt);
    }

    return [
      "results" => $results,
      "chart_type" => $chartType
    ];
  }

  public function reportType($data, $type, $filterByCreatedAt, $duration = null, $from = null, $to = null, $date = null)
  {
    switch ((int)$type) {
      case ReportReturnTypeEnum::Chart:
        return $this->chartType($data, $filterByCreatedAt, $duration, $from, $to, $date);

      default:
        return $this->accumulationType($data, $filterByCreatedAt);
    }
  }
}
