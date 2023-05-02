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
    if($wrong_answer_count < 3):
        $op = $wrong_answer_count*0.33;
    else:
        $val = fmod($wrong_answer_count, 3);
        $op = ($val == 0) ? $wrong_answer_count/3 : floor($wrong_answer_count/3)+($val*0.33);
    endif;
   return $op;
}
?>