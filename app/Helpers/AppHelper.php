<?php


namespace App\Helpers;


use App\Models\AcademicYear;

class AppHelper
{
    public static function getAcademicYear(){
        $academic_year=AcademicYear::where('status','1')->first();
        return $academic_year;
    }
}
