<?php

namespace App\Http\Controllers;

use App\Models\SubjectLevel;
use Illuminate\Http\Request;

class SubjectLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = SubjectLevel::all();
        return view('admin.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:subject_levels,name'
        ]);
        $input = $request->all();               
        SubjectLevel::create($input);
        return redirect()->route('level')->with('success', 'Subject Level Created Successfully!');
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
        $level = SubjectLevel::find($id);
        return view('admin.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:subject_levels,name,'.$id
        ]);
        $input = $request->all();
        $level = SubjectLevel::find($id);               
        $level->update($input);
        return redirect()->route('level')->with('success', 'Subject Level Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubjectLevel::find($id)->delete();
        return redirect()->route('level')->with('success', 'Subject Level Deleted Successfully!');
    }
}
