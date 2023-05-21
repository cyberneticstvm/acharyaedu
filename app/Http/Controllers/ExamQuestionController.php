<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Chapter;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Month;
use App\Models\Question;
use App\Models\QuestionCourse;
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
        $mid = Exam::max('id');
        $eqs = ExamQuestion::leftJoin('exams as e', 'e.id', 'exam_questions.exam_id')->select('exam_questions.id', 'exam_questions.exam_id', 'exam_questions.question_id')->whereDate('e.exam_date', '>=', Carbon::today())->where('exam_questions.exam_id', $mid)->get();
        return view('admin.exam-question.index', compact('eqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $this->validate($request, [
            /*'level_id' => 'required',
            'subject_id' => 'required',
            'topic_id' => 'required',*/
            'number_of_questions' => 'required'
        ]);
        $input = $request->all(); $exam = Exam::find($id);
        if($exam->exam_type == 1): // General       
            $questions = Question::where('subject_id', $request->subject_id)->whereIn('id', QuestionLevel::whereIn('level_id', $request->level_id)->pluck('question_id'))->where('topic_id', $request->topic_id)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        endif;
        if($exam->exam_type == 2): // SCERT
            $questions = Question::where('subject_id', $request->subject_id)->whereIn('id', QuestionLevel::whereIn('level_id', $request->level_id)->pluck('question_id'))->where('chapter_id', $request->chapter)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        endif;
        if($exam->exam_type == 3): // Previous
            $questions = Question::where('exam_type', $exam->exam_type)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        endif;
        if($exam->exam_type == 4): // Model
            $questions = Question::where('subject_id', $request->subject_id)->where('exam_type', $request->questions_from)->whereIn('id', QuestionLevel::whereIn('level_id', $request->level_id)->pluck('question_id'))->where('topic_id', $request->topic_id)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        endif;
        if($exam->exam_type == 5): // Current Affairs
            $questions = Question::where('subject_id', $request->subject_id)->where('month', $request->month)->where('year', $request->year)->whereIn('id', QuestionLevel::whereIn('level_id', $request->level_id)->pluck('question_id'))->where('topic_id', $request->topic_id)->where('status', 1)->inRandomOrder()->limit($request->number_of_questions)->get();
        endif;
        
        if($questions->isEmpty()):
            return redirect("/admin/eq/create/$id")->with('error', 'No records found')->withInput($request->all());
        else:        
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
        $levels = SubjectLevel::all(); $chapters = Chapter::all(); $months = Month::all();
        $qcount = ExamQuestion::where('exam_id', $id)->count('id'); $max = $exam->question_count - $qcount;
        return view('admin.exam-question.create', compact('exam', 'subjects', 'topics', 'levels', 'max', 'chapters', 'months'));
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
