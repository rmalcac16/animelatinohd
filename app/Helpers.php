<?php

use Illuminate\Support\Str;

function isMobileDevice()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileKeywords = [
        'mobile', 'android', 'iphone', 'ipod', 'blackberry',
        'webos', 'opera mini', 'windows phone', 'iemobile',
    ];
    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }
    return false;
}

function formatViews($views)
{
    $abbreviations = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K'];
    foreach ($abbreviations as $exponent => $abbreviation) {
        if ($views >= pow(10, $exponent)) {
            return round($views / pow(10, $exponent), 1) . $abbreviation;
        }
    }
    return $views;
}

function limitString($string, $quantity) : String {
    return Str::limit($string, $quantity, '...');
}


?>