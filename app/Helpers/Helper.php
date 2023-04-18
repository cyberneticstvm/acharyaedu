<?php

use App\Models\CourseOffer;
use App\Models\StudentExam;

function courseOffers(){
   return CourseOffer::all();
}

function albhabets(){
    return array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E');
}

function isStudentAttended($sid, $eid){
    $se = StudentExam::where('student_id', $sid)->where('exam_id', $eid)->get();
    return ($se->isEmpty()) ? false : true;
}
?>