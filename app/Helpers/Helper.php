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

function getStudentScore($sid, $eid){
    $se = StudentExam::where('student_id', $sid)->where('exam_id', $eid)->first();
    return $se;
}

function cutoffMark($wrong_answer_count){
    $op = 0;
    if($wrong_answer_count == 0):
        $op = 0;
    elseif($wrong_answer_count % 3 == 0):
        $op = $wrong_answer_count/3;
    elseif($wrong_answer_count % 3 < 0):
        $op = $wrong_answer_count*0.33;
    elseif($wrong_answer_count % 3 == 1):
        $op = ($wrong_answer_count/3) + 0.33;
    elseif($wrong_answer_count % 3 == 2):
        $op = ($wrong_answer_count/3) + 0.66;
    endif;
    return $op;
}
?>