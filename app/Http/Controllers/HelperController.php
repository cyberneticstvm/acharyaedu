<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\FreeExamScore;
use App\Models\Gallery;
use App\Models\Question;
use App\Models\StudentBatch;
use App\Models\StudentExamScore;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\Subject;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    /*public function test(){
        $exams = Exam::whereDate('exam_date', Carbon::today())->get();
        foreach($exams as $key => $exam):
            $studentexams = StudentExam::where('exam_id', $exam->id)->orderBy('total_mark_after_cutoff')->get();
            foreach($studentexams as $key1 => $sxam):
                StudentExam::where('id', $sxam->id)->update(['grade' => $key1+1]);
            endforeach;
        endforeach;
        return view('test');
    }*/

    public function test()
    {
        $questions = Question::where('status', 1)->where('exam_type', 2)->inRandomOrder()->limit(50)->get();
        $data = [];
        foreach ($questions as $key1 => $que) :
            $data[] = [
                'exam_id' => 138,
                'question_id' => $que->id,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        endforeach;
        ExamQuestion::insert($data);
    }

    public function module(Request $request)
    {
        $data = Topic::where('subject_id', $request->sid)->select('id', 'name')->inRandomOrder()->when($request->random > 0, function ($query) use ($request) {
            return $query->limit($request->random);
        })->get();
        return response()->json($data);
    }

    public function studentperfchart($id, $type)
    {
        if ($type == 'free') :
            $score = FreeExamScore::leftJoin('subjects as s', 's.id', 'free_exam_scores.subject_id')->where('student_exam_id', $id)->selectRaw('free_exam_scores.subject_id, s.name as sname, COUNT(free_exam_scores.id) as qcount, COUNT(CASE WHEN free_exam_scores.answer = 1 THEN free_exam_scores.answer END) AS correct, COUNT(CASE WHEN free_exam_scores.answer = 0 THEN free_exam_scores.answer END) AS wrong, COUNT(CASE WHEN free_exam_scores.answer IS NULL THEN free_exam_scores.answer END) AS unattended')->groupBy('free_exam_scores.subject_id', 's.name')->get();
        else :
            $score = StudentExamScore::leftJoin('subjects as s', 's.id', 'student_exam_scores.subject_id')->where('student_exam_id', $id)->selectRaw('student_exam_scores.subject_id, s.name as sname, COUNT(student_exam_scores.id) as qcount, COUNT(CASE WHEN student_exam_scores.answer = 1 THEN student_exam_scores.answer END) AS correct, COUNT(CASE WHEN student_exam_scores.answer = 0 THEN student_exam_scores.answer END) AS wrong, COUNT(CASE WHEN student_exam_scores.answer IS NULL THEN student_exam_scores.answer END) AS unattended')->groupBy('student_exam_scores.subject_id', 's.name')->get();
        endif;
        return json_encode($score);
    }

    public function studentperfchartall()
    {
        /*if($type == 'free'):
            $score = FreeExamScore::leftJoin('free_exams as se', 'se.id', 'free_exam_scores.student_exam_id')->leftJoin('subjects as s', 's.id', 'free_exam_scores.subject_id')->where('se.student_id', Auth::user()->student->id)->selectRaw('free_exam_scores.subject_id, s.name as sname, COUNT(free_exam_scores.id) as qcount, COUNT(CASE WHEN free_exam_scores.answer = 1 THEN free_exam_scores.answer END) AS correct, COUNT(CASE WHEN free_exam_scores.answer = 0 THEN free_exam_scores.answer END) AS wrong, COUNT(CASE WHEN free_exam_scores.answer IS NULL THEN free_exam_scores.answer END) AS unattended')->groupBy('free_exam_scores.subject_id', 's.name')->get();
        endif;*/
        $score = StudentExamScore::leftJoin('student_exams as se', 'se.id', 'student_exam_scores.student_exam_id')->leftJoin('subjects as s', 's.id', 'student_exam_scores.subject_id')->where('se.student_id', Auth::user()->student->id)->selectRaw('student_exam_scores.subject_id, s.name as sname, COUNT(student_exam_scores.id) as qcount, COUNT(CASE WHEN student_exam_scores.answer = 1 THEN student_exam_scores.answer END) AS correct, COUNT(CASE WHEN student_exam_scores.answer = 0 THEN student_exam_scores.answer END) AS wrong, COUNT(CASE WHEN student_exam_scores.answer IS NULL THEN student_exam_scores.answer END) AS unattended')->groupBy('student_exam_scores.subject_id', 's.name')->get();
        return json_encode($score);
    }

    public function modulequestions($id)
    {
        $questions = Question::where('topic_id', $id)->get();
        $module = Topic::find($id);
        return view('admin.misc.module-questions', compact('questions', 'module'));
    }

    public function subjectmodules($id)
    {
        $modules = Topic::where('subject_id', $id)->orderBy('name')->get();
        $subject = Subject::find($id);
        return view('admin.misc.subject-modules', compact('modules', 'subject'));
    }

    public function studentperformanceall()
    {
        $exams = [];
        $batches = Batch::all();
        $batch = [];
        return view('admin.reports.student-performance', compact('exams', 'batches', 'batch'));
    }

    public function studentperformanceallget(Request $request)
    {
        $this->validate($request, [
            'batch_id' => 'required',
        ]);
        $batch = Batch::find($request->batch_id);
        $exams = $batch->exams;
        $batches = Batch::all();
        return view('admin.reports.student-performance', compact('exams', 'batches', 'batch'));
    }

    public function studentperformanceexam($id)
    {
        $exam = Exam::find($id);
        $students = StudentBatch::where('batch', $exam->batch_id)->where('cancelled', 0)->get();
        return view('admin.reports.student-performance-exam', compact('exam', 'students'));
    }

    public function examresult($id)
    {
        $exam = StudentExam::find($id);
        if ($exam) :
            $student = Student::find($exam->student_id);
            return view('admin.student.result', compact('exam', 'student'));
        else :
            return redirect()->back()->with('error', "No records found.");
        endif;
    }

    public function examperformance($id)
    {
        if ($id > 0) :
            $e = StudentExam::find($id);
            $exam = StudentExamScore::where('student_exam_id', $id)->first();
            $student = Student::find($e->student_id);
            return view('admin.student.performance', compact('exam', 'student'));
        else :
            return redirect()->back()->with('error', "No result found");
        endif;
    }

    public function onam2023gal()
    {
        $gals = Gallery::where('type', 'image')->orderByDesc('id')->get();
        return view('onam-celeb-2023-gallery', compact('gals'));
    }
}
