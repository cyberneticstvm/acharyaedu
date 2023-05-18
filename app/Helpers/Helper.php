<?php

use App\Models\CourseOffer;
use App\Models\FreeStudentExam;
use App\Models\Question;
use App\Models\QuestionCourse;
use App\Models\StudentExam;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

function courseOffers(){
   return CourseOffer::all();
}

function albhabets(){
    return array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E');
}

function isStudentAttended($sid, $eid, $type=''){
    if($type == 'free'):
        $se = FreeStudentExam::where('student_id', $sid)->where('exam_id', $eid)->get();
    else:
        $se = StudentExam::where('student_id', $sid)->where('exam_id', $eid)->get();
    endif;
    return ($se->isEmpty()) ? false : true;
}

function getStudentScore($sid, $eid, $type=''){
    if($type == 'free'):
        $se = FreeStudentExam::where('student_id', $sid)->where('exam_id', $eid)->first();
    else:
        $se = StudentExam::where('student_id', $sid)->where('exam_id', $eid)->first();
    endif;
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

function studentsubjects(){
    $questions = QuestionCourse::when(Auth::user()->student->course_id > 0, function($query){
        return $query->where('course_id', Auth::user()->student->course_id);
    })->get();
    $quest = Question::whereIn('id', $questions->pluck('question_id'))->get();
    $studentsubjects = Subject::whereIn('id', $quest->pluck('subject_id'))->inRandomOrder()->limit(3)->get();
    return $studentsubjects;
}
?>