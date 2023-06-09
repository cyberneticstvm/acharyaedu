<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etypes = ExamType::all();
        return view('admin.subject.create', compact('etypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'exam_type' => 'required',
        ]);
        $input = $request->all();               
        Subject::create($input);
        return redirect()->route('subject')->with('success', 'Subject Created Successfully!');
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
        $subject = Subject::find($id); $etypes = ExamType::all();
        return view('admin.subject.edit', compact('subject', 'etypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'exam_type' => 'required',
        ]);
        $input = $request->all();
        $subject = Subject::find($id);               
        $subject->update($input);
        return redirect()->route('subject')->with('success', 'Subject Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::find($id)->delete();
        return redirect()->route('subject')->with('success', 'Subject Deleted Successfully!');
    }
}
