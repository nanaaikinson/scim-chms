<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Enums\ExpenseTypeEnum;
use App\Enums\ReportDurationEnum;
use App\Enums\ReportReturnTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseReportController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    $date = $request->input("date");
    $from = $request->input("from") ?: null;
    $to = $request->input("to") ?: null;
    $duration = (int)$request->input("duration");
    $category = $request->input("category") ?: "all"; // Expense category
    $type = (int)$request->input("report_type"); // report type // Accumulation,

    $query = Expense::select("*");

    // Duration
    $query->where(function ($query) use ($duration, $date, $from, $to) {
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

    // Category
    $query->where(function ($query) use ($category) {
      if ($category !== "all") {
        $query->whereIn("type", $category);
      }
    });

    $results = $query->get();

    // Type
    if ($results->isNotEmpty()) {
      return $this->dataResponse($this->returnType($results, $type, $duration, $from, $to, $date));
    }
    return $this->dataResponse([]);
  }

  public function accumulationType($data)
  {
    $total = 0;
    $items = $data->map(function($record) use (&$total) {
      $total += $record->amount;

      return [
        "id" => $record->id,
        "mask" => $record->mask,
        "amount" => $record->amount,
        "name" => $record->name,
        "comment" => $record->comment,
        "date" => $record->date,
        "type" => (ExpenseTypeEnum::fromValue($record->type))->description
      ];
    });

    return ["total" => $total, "results" => $items];
  }

  public function chartType($data, $duration = null, $from = null, $to = null, $date = null)
  {
    $results = [];
    $chartType = "";

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
            $dataMonth = (int)date("m", strtotime($d->date));
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

    elseif ($duration == ReportDurationEnum::Year) {
      $chartType = "bar chart";
      $start = 1;
      $end = 12;

      for ($i = $start; $i <= $end; $i++) {
        // Set month data
        $monthData = ["name" => get_month_name($i), "total" => 0];

        // Loop through data
        foreach ($data as $d) {
          $dataMonth = (int)date("m", strtotime($d->date));
          if ($dataMonth !== $i) continue;

          $monthData["total"] += $d->amount;
        }

        $results[] = $monthData;
      }
    }

    elseif ($duration == ReportDurationEnum::Month) {
      $chartType = "bar chart";
      $weeks = weeks_in_month(Carbon::parse($date)->month, Carbon::parse($date)->year);

      for ($i = 1; $i <= $weeks; $i++) {
        $weekData = ["name" => "Week {$i}", "total" => 0];

        foreach ($data as $d) {
          $dataWeek = Carbon::parse($d->date)->weekNumberInMonth;

          if ($dataWeek == $i) {
            $weekData["total"] += $d->amount;
          }
        }
        $results[] = $weekData;
      }
    }

    elseif ($duration == ReportDurationEnum::Week) {
      $chartType = "bar chart";
      $startDay = 0;
      $endDay= 6;

      for ($i = $startDay; $i <= $endDay; $i++) {
        $dayData = ["name" => get_day_name($i), "total" => 0];

        foreach ($data as $d) {
          $dataDay = Carbon::parse($d->date)->dayOfWeek;

          if ($dataDay == $i) {
            $dayData["total"] += $d->amount;
          }
        }

        $results[] = $dayData;
      }
    }

    else {
      $results = $this->accumulationType($data);
    }

    return [
      "results" => $results,
      "chart_type" => $chartType
    ];
  }

  public function returnType($data, $type = null, $duration = null, $from = null, $to = null, $date = null)
  {
    switch ((int)$type) {
      case ReportReturnTypeEnum::Chart:
        return $this->chartType($data, $duration, $from, $to, $date);

      default:
        return $this->accumulationType($data);
    }
  }
}
