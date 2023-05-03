<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentBatch;
use App\Models\StudentExamScore;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function studentperfchartall(){
        $score = StudentExamScore::leftJoin('student_exams as se', 'se.id', 'student_exam_scores.student_exam_id')->leftJoin('subjects as s', 's.id', 'student_exam_scores.subject_id')->where('se.student_id', Auth::user()->student->id)->selectRaw('student_exam_scores.subject_id, s.name as sname, COUNT(student_exam_scores.id) as qcount, COUNT(CASE WHEN student_exam_scores.answer = 1 THEN student_exam_scores.answer END) AS correct, COUNT(CASE WHEN student_exam_scores.answer = 0 THEN student_exam_scores.answer END) AS wrong, COUNT(CASE WHEN student_exam_scores.answer IS NULL THEN student_exam_scores.answer END) AS unattended')->groupBy('student_exam_scores.subject_id', 's.name')->get();
        return json_encode($score);
    }

    public function modulequestions($id){
        $questions = Question::where('topic_id', $id)->get();
        $module = Topic::find($id);
        return view('admin.misc.module-questions', compact('questions', 'module'));
    }

    public function subjectmodules(Request $request){
        $id = $request->sid; $random = $request->random;
        $modules = Topic::where('subject_id', $id)->inRandomOrder()->when($random > 0, function($query) use($request) {
            return $query->limit($request->random);
        })->orderBy('name')->get();
        $subject = Subject::find($id);
        return view('admin.misc.subject-modules', compact('modules', 'subject'));
    }

    public function studentperformanceall(){
        $exams = []; $batches = Batch::all(); $batch = [];
        return view('admin.reports.student-performance', compact('exams', 'batches', 'batch'));
    }

    public function studentperformanceallget(Request $request){
        $this->validate($request, [
            'batch_id' => 'required',
        ]);
        $batch = Batch::find($request->batch_id);
        $exams = $batch->exams; $batches = Batch::all();
        return view('admin.reports.student-performance', compact('exams', 'batches', 'batch'));
    }

    public function studentperformanceexam($id){
        $exam = Exam::find($id);
        $students = StudentBatch::where('batch', $exam->batch_id)->where('cancelled', 0)->get();
        return view('admin.reports.student-performance-exam', compact('exam', 'students'));
    }

    public function examresult($id){
        $exam = StudentExam::find($id);
        if($exam):
            $student = Student::find($exam->student_id);
            return view('admin.student.result', compact('exam', 'student'));
        else:
            return redirect()->back()->with('error', "No records found.");
        endif;
    }

    public function examperformance($id){
        if($id > 0):
            $e = StudentExam::find($id);
            $exam = StudentExamScore::where('student_exam_id', $id)->first();
            $student = Student::find($e->student_id);
            return view('admin.student.performance', compact('exam', 'student'));
        else:
            return redirect()->back()->with('error', "No result found");
        endif;
    }
}
