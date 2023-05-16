<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Subject;
use App\Models\SubjectLevel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Chart\Chart;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::all();
        return view('admin.chapter.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::pluck('name', 'id')->all();
        $levels = SubjectLevel::where('category', 'Standard')->pluck('name', 'id')->all();
        return view('admin.chapter.create', compact('subjects', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'level_id' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;               
        $input['updated_by'] = $request->user()->id;               
        Chapter::create($input);
        return redirect()->route('chapter')->with('success', 'Chapter Created Successfully!');
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
        $subjects = Subject::pluck('name', 'id')->all();
        $levels = SubjectLevel::where('category', 'Standard')->pluck('name', 'id')->all();
        $chapter = Chapter::find(decrypt($id));
        return view('admin.chapter.edit', compact('subjects', 'levels', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'level_id' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();              
        $input['updated_by'] = $request->user()->id;               
        $chapter = Chapter::find($id);
        $chapter->update($input);
        return redirect()->route('chapter')->with('success', 'Chapter Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Chapter::find($id)->delete();
        return redirect()->route('chapter')->with('success', 'Chapter Deleted Successfully!');
    }
}
