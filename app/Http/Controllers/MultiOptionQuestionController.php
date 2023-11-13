<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\MultiOptionQuestion;
use App\Models\MultiOptionQuestionBatch;
use App\Models\Subject;
use Illuminate\Http\Request;

class MultiOptionQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = MultiOptionQuestion::latest()->get();
        return view('admin.multi-option-question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('exam_type', 1)->get();
        $batches = Batch::where('status', 1)->get();
        return view('admin.multi-option-question.create', compact('subjects', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'batch_id' => 'array|present',
        ]);
        $qid = MultiOptionQuestion::create([
            'question' => $request->question,
            'subject_id' => $request->subject_id,
            'option_a' => $request->options[0],
            'option_b' => $request->options[1],
            'option_c' => $request->options[2],
            'option_d' => $request->options[3],
            'correct_option' => $request->correct_option,
            'explanation' => $request->explanation
        ])->id;
        foreach ($request->batch_id as $key => $batch) :
            $batches[] = [
                'question_id' => $qid,
                'batch_id' => $batch,
            ];
        endforeach;
        MultiOptionQuestionBatch::insert($batches);
        return redirect()->route('multi-option')->with('success', 'Question Saved Successfully!');
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
        $subjects = Subject::where('exam_type', 1)->get();
        $question = MultiOptionQuestion::find($id);
        $batches = Batch::where('status', 1)->get();
        return view('admin.multi-option-question.edit', compact('subjects', 'question', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'batch_id' => 'array|present',
        ]);
        MultiOptionQuestion::findOrFail($id)->update([
            'question' => $request->question,
            'subject_id' => $request->subject_id,
            'option_a' => $request->options[0],
            'option_b' => $request->options[1],
            'option_c' => $request->options[2],
            'option_d' => $request->options[3],
            'correct_option' => $request->correct_option,
            'explanation' => $request->explanation
        ]);
        foreach ($request->batch_id as $key => $batch) :
            $batches[] = [
                'question_id' => $id,
                'batch_id' => $batch,
            ];
        endforeach;
        MultiOptionQuestionBatch::where('question_id', $id)->delete();
        MultiOptionQuestionBatch::insert($batches);
        return redirect()->route('multi-option')->with('success', 'Question updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MultiOptionQuestion::find($id)->delete();
        return redirect()->route('multi-option')->with('success', 'Question Deleted Successfully!');
    }
}
