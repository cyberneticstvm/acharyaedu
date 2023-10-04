<?php

use App\Models\Batch;
use App\Models\Course;
use App\Models\CourseOffer;
use App\Models\FreeStudentExam;
use App\Models\Question;
use App\Models\QuestionCourse;
use App\Models\StudentExam;
use App\Models\ExamQuestion;
use App\Models\Slider;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

function courseOffers(){
   return CourseOffer::all();
}

function getAllCourses(){
    return Course::all();
}

function getAllModules(){
    return Topic::all();
}

function getAllSubjects(){
    return Subject::all();
}

function getActiveBatches(){
    return Batch::where('status', 1)->get();
}

function albhabets(){
    return array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E');
}

function sliders(){
    return Slider::orderBy('order', 'ASC')->get();
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

function getModules($exam){
    $topics = Question::leftJoin('topics as t', 'questions.topic_id', 't.id')->whereIn('questions.id', ExamQuestion::where('exam_id', $exam)->pluck('question_id'))->groupBy('t.name')->pluck('t.name')->implode(',');
    return $topics;
}

function getFeePendingDetails($studentid){
    $feemy = "";
    $student = Student::findOrFail($studentid);
    $fees = $student->batchFee;
    foreach($fees as $key => $fee):
        $feemy .= $fee->feemonth?->name.'-'.$fee->fee_year.', ';
    endforeach;
    return $feemy;
}
?>