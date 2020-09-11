<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Enums\ReportDurationEnum;
use App\Enums\ReportGenderEnum;
use App\Enums\ReportReturnTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\AttendancePerson;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{
  use ResponseTrait;

  // TODO: Refactor code to include group names

  public function index(Request $request)
  {
    try {
      $status = (int)$request->input("status");
      $type = (int)$request->input("type");
      $duration = (int)$request->input("duration");
      $for = (int)$request->input("for");
      $group_id = $request->input("group_id");
      $from = $request->input("from");
      $to = $request->input("to");
      $date = $request->input("date"); // 2020-08-10 // 01-12 // 2020
      $gender = (int)$request->input("gender");
      $priority = "";

      $query = AttendancePerson::select("attendance_people.*", "attendances.date", "people.*")
        ->leftJoin("attendances", "attendances.id", "=", "attendance_people.attendance_id")
        ->leftJoin("people", "people.id", "=", "attendance_people.person_id");

      // Status
      $query->where(function ($query) use ($status) {
        if ($status == ST_ABSENT) {
          $query->where("attendance_people.status", ST_ABSENT);
        }
        if ($status == ST_PRESENT) {
          $query->where("attendance_people.status", ST_PRESENT);
        }
        if ($status == ST_PRESENT_ABSENT) {
          $query->where("attendance_people.status", ST_PRESENT)
            ->orWhere("attendance_people.status", ST_ABSENT);
        }
      });

      // Duration
      $query->where(function ($query) use ($duration, $date, $from, $to) {
        if ($duration == ReportDurationEnum::Day) {
          $query->whereDate("attendances.date", $date);
        }
        if ($duration == ReportDurationEnum::Week) {
          $week = Carbon::parse($date)->weekOfYear;
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear("attendances.date", $year)->where(DB::raw("WEEKOFYEAR(attendances.date)"), $week);
        }
        if ($duration == ReportDurationEnum::Month) {
          $month = Carbon::parse($date)->format("m");
          $year = Carbon::parse($date)->format("Y");

          $query->whereYear("attendances.date", $year)->whereMonth("attendances.date", $month);
        }
        if ($duration == ReportDurationEnum::Year) {
          $query->whereYear("attendances.date", $date);
        }
        if ($duration == ReportDurationEnum::Period) {
          $query->whereBetween("attendances.date", [$from, $to]);
        }
      });

      // For
      $query->where(function ($query) use ($for, $group_id) {
        if ($for == 2) {
          $query->whereIn("attendances.group_id", $group_id);
        }
      });

      // Gender
      $query->where(function ($query) use ($gender) {
        $sex = ReportGenderEnum::fromValue($gender);

        if ($gender == ReportGenderEnum::Male) {
          $query->where("people.gender", strtolower($sex->description));
        }
        if ($gender == ReportGenderEnum::Female) {
          $query->where("people.gender", strtolower($sex->description));
        }
        if ($gender == ReportGenderEnum::All) {
          $query->where("people.gender", "male")->orWhere("people.gender", "female");
        }
      });

      // Type
      //$data = $query->toSql();
      $results = $query->get();

      if ($results->isNotEmpty()) {
        return $this->dataResponse($this->returnType($results, $type, $status, $duration, $from, $to, $date));
      }
      return $this->dataResponse([]);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function countType($data, $status)
  {
    $count = (object)["attendees" => 0, "absentees" => 0];

    $results = $data->map(function ($result) use ($count, $status) {
      // Count
      if ($result->status == ST_PRESENT) {
        $count->attendees += 1;
      } else {
        $count->absentees += 1;
      }

      if ($status == ST_ABSENT && $result->status == ST_ABSENT) {
        return [
          "mask" => $result->mask,
          "name" => "{$result->first_name} {$result->first_last}",
          "primary_telephone" => $result->primary_telephone,
          "email" => $result->email,
          "gender" => $result->gender,
          "attendance_date" => $result->date
        ];
      }
      elseif ($status == ST_PRESENT && $result->status == ST_PRESENT) {
        return [
          "mask" => $result->mask,
          "name" => "{$result->first_name} {$result->first_last}",
          "primary_telephone" => $result->primary_telephone,
          "email" => $result->email,
          "gender" => $result->gender,
          "attendance_date" => $result->date
        ];
      }
      else {
        return [
          "mask" => $result->mask,
          "name" => "{$result->first_name} {$result->first_last}",
          "primary_telephone" => $result->primary_telephone,
          "email" => $result->email,
          "gender" => $result->gender,
          "attendance_date" => $result->date
        ];
      }
    });

    if ($status == ST_PRESENT) {
      unset($count->absentees);
    }
    if ($status == ST_ABSENT) {
      unset($count->attendees);
    }
    return ["count" => $count, "results" => $results];
  }

  public function chartType($data, $status, $duration = null, $from = null, $to = null, $date = null)
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
          $monthData = ["name" => get_month_name($i), "attendees" => 0, "absentees" => 0];

          // Loop through data
          foreach ($data as $d) {
            $dataMonth = (int)date("m", strtotime($d->date));
            if ($dataMonth !== $i) continue;

            if ($d->status == ST_PRESENT) {
              $monthData["attendees"] += 1;
            }
            if ($d->status == ST_ABSENT) {
              $monthData["absentees"] += 1;
            }
          }

          // Unset for status
          if ($status == ST_PRESENT) {
            unset($monthData["absentees"]);
          }
          if ($status == ST_ABSENT) {
            unset($monthData["attendees"]);
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

            $monthData = ["name" => get_month_name($i), "attendees" => 0, "absentees" => 0];

            // Loop through data
            foreach ($data as $d) {
              $dataMonth = (int)Carbon::parse($d->date)->format("m");
              $dataYear = (int)Carbon::parse($d->date)->format("Y");

              if ($dataYear == $year && $dataMonth == $i) {
                if ($d->status == ST_PRESENT) {
                  $monthData["attendees"] += 1;
                }
                if ($d->status == ST_ABSENT) {
                  $monthData["absentees"] += 1;
                }
              }
            }

            // Unset for status
            if ($status == ST_PRESENT) {
              unset($monthData["absentees"]);
            }
            if ($status == ST_ABSENT) {
              unset($monthData["attendees"]);
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
        $monthData = ["name" => get_month_name($i), "attendees" => 0, "absentees" => 0];

        // Loop through data
        foreach ($data as $d) {
          $dataMonth = (int)date("m", strtotime($d->date));

          if ($dataMonth !== $i) continue;

          if ($d->status == ST_PRESENT) {
            $monthData["attendees"] += 1;
          }
          if ($d->status == ST_ABSENT) {
            $monthData["absentees"] += 1;
          }
        }

        // Unset based on status
        if ($status == ST_PRESENT) {
          unset($monthData["absentees"]);
        }
        if ($status == ST_ABSENT) {
          unset($monthData["attendees"]);
        }

        $results[] = $monthData;
      }
    }

    elseif ($duration == ReportDurationEnum::Month) {
      $chartType = "bar chart";
      $weeks = weeks_in_month(Carbon::parse($date)->month, Carbon::parse($date)->year);

      for ($i = 1; $i <= $weeks; $i++) {
        $weekData = ["name" => "Week {$i}", "absentees" => 0, "attendees" => 0];

        foreach ($data as $d) {
          $dataWeek = Carbon::parse($d->date)->weekNumberInMonth;

          if ($dataWeek == $i && $d->status == ST_PRESENT) {
            $weekData["attendees"] += 1;
          }
          if ($dataWeek == $i && $d->status == ST_ABSENT) {
            $weekData["absentees"] += 1;
          }
        }

        // Unset based on status
        if ($status == ST_PRESENT) {
          unset($weekData["absentees"]);
        }
        if ($status == ST_ABSENT) {
          unset($weekData["attendees"]);
        }
        $results[] = $weekData;
      }
    }

    elseif ($duration == ReportDurationEnum::Week) {
      $chartType = "bar chart";
      $startDay = 0;
      $endDay= 6;

      for ($i = $startDay; $i <= $endDay; $i++) {
        $dayData = ["name" => get_day_name($i), "absentees" => 0, "attendees" => 0];

        foreach ($data as $d) {
          $dataDay = Carbon::parse($d->date)->dayOfWeek;

          if ($dataDay == $i && $d->status == ST_PRESENT) {
            $dayData["attendees"] += 1;
          }
          if ($dataDay == $i && $d->status == ST_ABSENT) {
            $dayData["absentees"] += 1;
          }
        }

        // Unset based on status
        if ($status == ST_PRESENT) {
          unset($dayData["absentees"]);
        }
        if ($status == ST_ABSENT) {
          unset($dayData["attendees"]);
        }
        $results[] = $dayData;
      }
    }

    else {
      $results = $this->countType($data, $status);
    }

    return ["chart_type" => $chartType,"results" => $results];
  }

  public function returnType($data, $type, $status, $duration, $from = null, $to = null, $date = null)
  {
    switch ((int)$type) {
      case ReportReturnTypeEnum::Chart:
        return $this->chartType($data, $status, $duration, $from, $to, $date);

      default:
        return $this->countType($data, $status);
    }
  }
}
