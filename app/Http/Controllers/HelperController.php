<?php

namespace App\Http\Controllers;

use App\Models\StudentExamScore;
use App\Models\Topic;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function module($sid){
        $data = Topic::where('subject_id', $sid)->select('id', 'name')->get();
        return response()->json($data);
    }

    public function studentperfchart($id){
        $score = StudentExamScore::leftJoin('subjects as s', 's.id', 'student_exam_scores.subject_id')->where('student_exam_id', $id)->selectRaw('student_exam_scores.subject_id, s.name as sname, COUNT(student_exam_scores.id) as qcount, COUNT(CASE WHEN student_exam_scores.answer = 1 THEN student_exam_scores.answer END) AS correct, COUNT(CASE WHEN student_exam_scores.answer = 0 THEN student_exam_scores.answer END) AS wrong, COUNT(CASE WHEN student_exam_scores.answer IS NULL THEN student_exam_scores.answer END) AS unattended')->groupBy('student_exam_scores.subject_id', 's.name')->get();
        return json_encode($score);
    }
}
