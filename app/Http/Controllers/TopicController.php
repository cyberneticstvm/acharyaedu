<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Subject;
use App\Models\Topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();
        $courses = Course::all();
        return view('admin.topic.index', compact('topics', 'courses'));
    }

    public function assign(Request $request){
        $this->validate($request, [
            'modules' => 'present|array',
            'course' => 'required',
        ]);
        $modules = $request->modules;
        $data = [];
        foreach($modules as $key => $module):
            $data [] = [
                'module' => $module,
                'course' => $request->course,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        endforeach;
        try{
            CourseModule::insert($data);
        }catch(Exception $e){
            //throw $e;
            return redirect()->back()->with('error', "Selected module(s) already been assigned to the Course")->withInput($request->all());
        }        
        return redirect()->back()->with('success', 'Module Assigned Successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.topic.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();               
        try{
            Topic::create($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('topic')->with('success', 'Topic Created Successfully!');
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
        $topic = Topic::find($id);
        return view('admin.topic.edit', compact('subjects', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'subject_id' => 'required',
        ]);
        $input = $request->all();               
        try{
            $topic = Topic::find($id);
            $topic->update($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('topic')->with('success', 'Topic Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Topic::find($id)->delete();
        return redirect()->route('topic')->with('success', 'Topic Deleted Successfully!');
    }
}
