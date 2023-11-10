<?php

namespace App\Http\Controllers;

use App\Models\MultiOptionQuestion;
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
        return view('admin.multi-option-question.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
        ]);
        MultiOptionQuestion::create([
            'question' => $request->question,
            'subject_id' => $request->subject_id,
            'option_a' => $request->option_id[0],
            'option_b' => $request->option_id[1],
            'option_c' => $request->option_id[2],
            'option_d' => $request->option_id[3],
            'correct_option' => $request->correct_option,
            'explanation' => $request->explanation
        ]);
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
        return view('admin.multi-option-question.edit', compact('subjects', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'subject_id' => 'required',
        ]);
        MultiOptionQuestion::findOrFail($id)->update([
            'question' => $request->question,
            'subject_id' => $request->subject_id,
            'option_a' => $request->option_id[0],
            'option_b' => $request->option_id[1],
            'option_c' => $request->option_id[2],
            'option_d' => $request->option_id[3],
            'correct_option' => $request->correct_option,
            'explanation' => $request->explanation
        ]);
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
