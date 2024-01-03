<?php

if (!function_exists('digitLocale')) {
    function digitLocale($number)
    {
        $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
        if (app()->getLocale() == 'bn') {
            return str_replace($en, $bn, $number);
        }
        return str_replace($bn, $en, $number);

    }
}