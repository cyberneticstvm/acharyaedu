<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use DB;

class PreviousQuestionController extends Controller
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
        $questions  = Question::where('exam_type', 3)->get();
        return view('admin.question-previous.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $option_count = $this->settings->option_count;
        return view('admin.question-previous.create', compact('option_count'));
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
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['subject_id'] = 0;
        $input['exam_type'] = 3;
        $input['topic_id'] = 0;
        try{
            DB::transaction(function() use ($request, $input) {
                $options = [];
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
                QuestionOption::insert($options);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('previousquestion')->with('success', 'Question Saved Successfully!');
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
        $question = Question::find($id);
        return view('admin.question-previous.edit', compact('question'));
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
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($request, $input, $id) {
                $options = [];
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
                QuestionOption::where('question_id', $question->id)->delete();
                QuestionOption::insert($options);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('previousquestion')->with('success', 'Question Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::find($id)->delete();
        return redirect()->route('previousquestion')->with('success', 'Question Deleted Successfully!');
    }
}
