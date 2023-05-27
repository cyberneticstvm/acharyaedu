<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('admin.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.faculty.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|digits:10',
            'subject_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;        
        $input['updated_by'] = $request->user()->id;               
        Faculty::create($input);
        return redirect()->route('faculty')->with('success', 'Faculty Created Successfully!');
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
        $subjects = Subject::all(); $faculty = Faculty::find(decrypt($id));
        return view('admin.faculty.edit', compact('subjects', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|digits:10',
            'subject_id' => 'required',
        ]);
        $input = $request->all();        
        $input['updated_by'] = $request->user()->id;               
        $faculty = Faculty::find($id);
        $faculty->update($input);
        return redirect()->route('faculty')->with('success', 'Faculty Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faculty::find($id)->delete();
        return redirect()->route('faculty')->with('success', 'Faculty Deleted Successfully!');
    }
}
