<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Question;
use App\Models\QuestionLevel;
use App\Models\QuestionOption;
use App\Models\Subject;
use App\Models\SubjectLevel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use DB;

class ScertQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $settings;
    public function __construct()
    {
        $this->settings = DB::table('settings')->where('id', 1)->first();
    }

    public function index()
    {
        //$questions  = Question::where('exam_type', 2)->get();
        $questions = Question::leftJoin('question_levels as ql', 'questions.id', 'ql.question_id')->selectRaw("COUNT(questions.id) AS qcount, subject_id, chapter_id, ql.level_id")->where('questions.exam_type', 2)->groupBy('subject_id', 'chapter_id', 'ql.level_id')->get();
        /*dd($questions);
        die;*/
        return view('admin.scert-question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('exam_type', 2)->get();
        $levels = SubjectLevel::where('category', 'Standard')->get();
        $chapters = Chapter::all();
        $option_count = $this->settings->option_count;
        return view('admin.scert-question.create', compact('subjects', 'levels', 'option_count', 'chapters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'options' => 'array|present',
            'correct_option' => 'required',
            'question' => 'required',
            'status' => 'required',
            'available_for_free' => 'required',
            'levels' => 'required',
            'subject_id' => 'required',
            'chapter_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['exam_type'] = 2;
        $input['topic_id'] = 0;
        try{
            DB::transaction(function() use ($request, $input) {
                $options = []; $levels = [];
                $question = Question::create($input);
                foreach($request->options as $key => $option):
                    $options[] = [
                        'question_id' => $question->id,
                        'option_id' => $input['option_id'][$key],
                        'option_name' => $option,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                foreach($request->levels as $key => $level):
                    $levels[] = [
                        'question_id' => $question->id,
                        'level_id' => $level,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                QuestionOption::insert($options);
                QuestionLevel::insert($levels);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('scertquestion')->with('success', 'Question Saved Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($level, $subject, $chapter)
    {
        $questions  = Question::leftJoin('question_levels as ql', 'questions.id', 'ql.question_id')->selectRaw("questions.id, questions.question")->where('exam_type', 2)->where('subject_id', $subject)->where('chapter_id', $chapter)->get();
        return view('admin.scert-question.show', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = Subject::where('exam_type', 2)->get();
        $levels = SubjectLevel::where('category', 'Standard')->get();
        $question = Question::find($id);
        $chapters = Chapter::all();
        return view('admin.scert-question.edit', compact('subjects', 'chapters', 'levels', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'options' => 'array|present',
            'correct_option' => 'required',
            'question' => 'required',
            'status' => 'required',
            'available_for_free' => 'required',
            'levels' => 'array|present',
            'subject_id' => 'required',
            'chapter_id' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($request, $input, $id) {
                $options = []; $levels = [];
                $question = Question::find($id);
                $question->update($input);
                foreach($request->options as $key => $option):
                    $options[] = [
                        'question_id' => $question->id,
                        'option_id' => $input['option_id'][$key],
                        'option_name' => $option,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                foreach($request->levels as $key => $level):
                    $levels[] = [
                        'question_id' => $question->id,
                        'level_id' => $level,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                QuestionOption::where('question_id', $question->id)->delete();
                QuestionLevel::where('question_id', $question->id)->delete();
                QuestionOption::insert($options);
                QuestionLevel::insert($levels);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('scertquestion')->with('success', 'Question Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::find($id)->delete();
        return redirect()->route('scertquestion')->with('success', 'Question Deleted Successfully!');
    }
}
