<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionCourse;
use App\Models\QuestionOption;
use App\Models\Subject;
use App\Models\SubjectLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;

class QuestionController extends Controller
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
        $questions  = Question::all();
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $levels = SubjectLevel::all();
        $courses = Course::all();
        $option_count = $this->settings->option_count;
        return view('admin.question.create', compact('subjects', 'levels', 'courses', 'option_count'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'courses' => 'array|present',
            'options' => 'array|present',
            'correct_option' => 'required',
            'question' => 'required',
            'status' => 'required',
            'available_for_free' => 'required',
            'level_id' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($request, $input) {
                $options = []; $courses = [];
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
                foreach($request->courses as $key => $course):
                    $courses[] = [
                        'question_id' => $question->id,
                        'course_id' => $course,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                QuestionOption::insert($options);
                QuestionCourse::insert($courses);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('question')->with('success', 'Question Saved Successfully!');
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
        $levels = SubjectLevel::all();
        $courses = Course::all();
        $question = Question::find($id);
        return view('admin.question.edit', compact('subjects', 'levels', 'courses', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'courses' => 'array|present',
            'options' => 'array|present',
            'correct_option' => 'required',
            'question' => 'required',
            'status' => 'required',
            'available_for_free' => 'required',
            'level_id' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($request, $input, $id) {
                $options = []; $courses = [];
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
                foreach($request->courses as $key => $course):
                    $courses[] = [
                        'question_id' => $question->id,
                        'course_id' => $course,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                QuestionOption::where('question_id', $question->id)->delete();
                QuestionCourse::where('question_id', $question->id)->delete();
                QuestionOption::insert($options);
                QuestionCourse::insert($courses);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('question')->with('success', 'Question Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::find($id)->delete();
        return redirect()->route('question')->with('success', 'Question Deleted Successfully!');
    }
}
