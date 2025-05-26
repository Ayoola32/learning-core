<?php


// Convert minutes to hours and minutes
if (!function_exists('minutesToHoursAndMinutes')) {
    function minutesToHoursAndMinutes(int $minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    return sprintf('%d Hrs  %02d Min', $hours, $remainingMinutes);
    }
}
      