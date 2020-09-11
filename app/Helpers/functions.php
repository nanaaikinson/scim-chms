<?php

if (!function_exists("generate_mask")) {
  function generate_mask() {
    return rand(1111, 9999999);
  }
}

if (!function_exists("in_production")) {
  function in_production() {
    return config("app.env") == "production";
  }
}

if (!function_exists("is_valid_excel")) {
  function is_valid_excel($ext) {
    $extensions = ['csv', 'xls', 'xlsx'];
    return in_array($ext, $extensions);
  }
}

if (!function_exists("follow_up_type")) {
  function follow_up_type($status) {
    switch ((int) $status) {
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
  function get_month_name($num) {
    switch ((int)$num) {
      Case 1:
        return "Jan";
      Case 2:
        return "Feb";
      Case 3:
        return "Mar";
      Case 4:
        return "Apr";
      Case 5:
        return "May";
      Case 6:
        return "Jun";
      Case 7:
        return "Jul";
      Case 8:
        return "Aug";
      Case 9:
        return "Sep";
      Case 10:
        return "Oct";
      Case 11:
        return "Nov";
      default:
        return "Dec";
    }
  }
}

if (!function_exists("get_day_name")) {
  function get_day_name($num) {
    switch ((int)$num) {
      Case 1:
        return "Monday";
      Case 2:
        return "Tuesday";
      Case 3:
        return "Wednesday";
      Case 4:
        return "Thursday";
      Case 5:
        return "Friday";
      Case 6:
        return "Saturday";
      default:
        return "Sunday";
    }
  }
}

if (!function_exists("weeks_in_month")) {
  function weeks_in_month($month, $year){
    $firstDay = date("w", mktime(0, 0, 0, $month, 1, $year));
    $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year));
    return 1 + ceil(($lastDay-7+$firstDay)/7);
  }
}
