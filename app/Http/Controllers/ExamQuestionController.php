<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\QuestionLevel;
use App\Models\Subject;
use App\Models\SubjectLevel;
use App\Models\Topic;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eqs = ExamQuestion::leftJoin('exams as e', 'e.id', 'exam_questions.exam_id')->select('exam_questions.id', 'exam_questions.exam_id', 'exam_questions.question_id')->whereDate('e.exam_date', '>=', Carbon::today())->get();
        return view('admin.exam-question.index', compact('eqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $this->validate($request, [
            'level_id' => 'required',
            'subject_id' => 'required',
            'topic_id' => 'required',
            'number_of_questions' => 'required'
        ]);
        $input = $request->all();        
        $questions = Question::where('subject_id', $request->subject_id)->whereIn('question_id', QuestionLevel::where('level_id', $request->level_id)->pluck('question_id'))->where('topic_id', $request->topic_id)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        if($questions->isEmpty()):
            return redirect("/admin/eq/create/$id")->with('error', 'No records found')->withInput($request->all());
        else:
            $exam = Exam::find($id);            
            return view('admin.exam-question.question', compact('questions', 'exam'));
        endif;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'questions' => 'array|present',
        ]);
        $input = $request->all();
        $data = [];
        foreach($request->questions as $key => $value):
            $data [] = [
                'exam_id' => $request->exam_id,
                'question_id' => $value,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
            ];
        endforeach;
        ExamQuestion::insert($data);
        return redirect()->route('eq')->with('success', 'Questions Updated Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exam::find($id);
        $subjects = Subject::all();
        $topics = Topic::all();
        $levels = SubjectLevel::all();
        $qcount = ExamQuestion::where('exam_id', $id)->count('id'); $max = $exam->question_count - $qcount;
        return view('admin.exam-question.create', compact('exam', 'subjects', 'topics', 'levels', 'max'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExamQuestion::find($id)->delete();
        return redirect()->route('eq')->with('success', 'Questions Deleted Successfully!');
    }
}
