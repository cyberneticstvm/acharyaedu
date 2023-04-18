<?php

use App\Models\CourseOffer;
use App\Models\StudentExam;
use Illuminate\Support\Facades\Auth;

function courseOffers(){
   return CourseOffer::all();
}

function albhabets(){
    return array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E');
}

function isStudentAttended($id){
    $se = StudentExam::where('student_id', $id)->first();
    return ($se->isEmpty()) ? false : true;
}
?>