<?php

if (!function_exists("generate_mask")) {
  function generate_mask($min = 1111, $max = 9999999): int
  {
    return rand($min, $max);
  }
}

if (!function_exists("in_production")) {
  function in_production(): bool
  {
    return config("app.env") == "production";
  }
}

if (!function_exists("is_valid_excel")) {
  function is_valid_excel($ext): bool
  {
    $extensions = ['csv', 'xls', 'xlsx'];
    return in_array($ext, $extensions);
  }
}

if (!function_exists("follow_up_type")) {
  function follow_up_type($status): string
  {
    switch ((int)$status) {
      case ST_FOLLOW_UP_PHONE:
        return "Phone";

      case ST_FOLLOW_UP_MESSAGE:
        return "Message";

      default:
        return "Visit";
    }
  }
}

if (!function_exists("get_month_name")) {
  function get_month_name($num): string
  {
    switch ((int)$num) {
      case 1:
        return "Jan";
      case 2:
        return "Feb";
      case 3:
        return "Mar";
      case 4:
        return "Apr";
      case 5:
        return "May";
      case 6:
        return "Jun";
      case 7:
        return "Jul";
      case 8:
        return "Aug";
      case 9:
        return "Sep";
      case 10:
        return "Oct";
      case 11:
        return "Nov";
      default:
        return "Dec";
    }
  }
}

if (!function_exists("get_day_name")) {
  function get_day_name($num): string
  {
    switch ((int)$num) {
      case 1:
        return "Monday";
      case 2:
        return "Tuesday";
      case 3:
        return "Wednesday";
      case 4:
        return "Thursday";
      case 5:
        return "Friday";
      case 6:
        return "Saturday";
      default:
        return "Sunday";
    }
  }
}

if (!function_exists("weeks_in_month")) {
  function weeks_in_month($month, $year)
  {
    $firstDay = date("w", mktime(0, 0, 0, $month, 1, $year));
    $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year));
    return 1 + ceil(($lastDay - 7 + $firstDay) / 7);
  }
}
