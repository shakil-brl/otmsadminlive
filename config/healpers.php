<?php

if (!function_exists('digitLocale')) {
    function digitLocale($number)
    {
        $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এ.এম", "পি.এম", "এ.এম", "পি.এম","শনিবার", "রবিবার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহস্পতিবার", "শুক্রবার"];
        $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "am", "pm", "AM", "PM","Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        if (app()->getLocale() == 'bn') {
            return str_replace($en, $bn, $number);
        }
        return str_replace($bn, $en, $number);

    }
}


if (!function_exists('dateView')) {
    function dateView($date)
    {
        if ($date == null || $date == '' || $date == 0) {
            return;
        }
        return date('d/m/Y', strtotime($date));
    }
}

