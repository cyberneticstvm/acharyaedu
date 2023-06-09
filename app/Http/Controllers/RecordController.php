<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;
use Svg\Tag\Rect;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = Record::all();
        return view('admin.recordings.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('exam_type', 1)->get();
        return view('admin.recordings.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subject_id' => 'required',
            'type' => 'required',
            'category' => 'required',
            'video_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        try{
            $record = Record::create($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('record')->with('success', 'Record created successfully');
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
        $subjects = Subject::where('exam_type', 1)->get(); $record = Record::find(decrypt($id));
        return view('admin.recordings.edit', compact('subjects', 'record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'subject_id' => 'required',
            'type' => 'required',
            'category' => 'required',
            'video_id' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            $record = Record::find($id);
            $record->update($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('record')->with('success', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Record::find($id)->delete();
        return redirect()->route('record')->with('success', 'Record deleted successfully');
    }
}
