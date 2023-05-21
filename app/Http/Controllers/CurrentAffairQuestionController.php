<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Month;
use App\Models\Question;
use App\Models\QuestionLevel;
use App\Models\QuestionOption;
use App\Models\Subject;
use App\Models\SubjectLevel;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;

class CurrentAffairQuestionController extends Controller
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
        $questions  = Question::where('exam_type', 5)->get();
        return view('admin.question-caffair.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $levels = SubjectLevel::where('category', 'General')->get();
        $courses = Course::all();
        $topics = Topic::all(); $months = Month::all();
        $option_count = $this->settings->option_count;
        return view('admin.question-caffair.create', compact('subjects', 'topics', 'levels', 'courses', 'option_count', 'months'));
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
            'levels' => 'array|present',
            'subject_id' => 'required',
            'topic_id' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['exam_type'] = 5;
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
        return redirect()->route('caffairquestion')->with('success', 'Question Saved Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = Subject::all();
        $levels = SubjectLevel::where('category', 'General')->get();
        $courses = Course::all();
        $question = Question::find($id);
        $topics = Topic::all(); $months = Month::all();
        return view('admin.question-caffair.edit', compact('subjects', 'topics', 'levels', 'courses', 'question', 'months'));
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
            'topic_id' => 'required',
            'month' => 'required',
            'year' => 'required',
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
        return redirect()->route('caffairquestion')->with('success', 'Question Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::find($id)->delete();
        return redirect()->route('caffairquestion')->with('success', 'Question Deleted Successfully!');
    }
}
