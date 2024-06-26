<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchCourse;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Faculty;
use App\Models\ModuleCompleteStatus;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

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
            'course' => 'present|array',
        ]);           
        try{
            foreach($request->course as $key1 => $course):
                $data = [];
                foreach($request->modules as $key => $module):
                    $data [] = [
                        'module' => $module,
                        'course' => $course,
                        'created_by' => $request->user()->id,
                        'updated_by' => $request->user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                CourseModule::insert($data);
            endforeach;            
        }catch(Exception $e){
            //throw $e;
            return redirect()->back()->with('error', "Selected module(s) already been assigned to the Course")->withInput($request->all());
        }        
        return redirect()->back()->with('success', 'Module Assigned Successfully!');
    }

    public function showmodule(){
        $batches = Batch::all(); $modules = collect(); $batch = 0; $topics = collect();
        return view('admin.module.index', compact('batches', 'modules', 'batch', 'topics'));
    }

    public function fetchmodule(Request $request){
        $this->validate($request, [
            'batch' => 'required',
        ]);
        $batches = Batch::all(); $faculties = Faculty::all(); $batch = $request->batch;
        $modules = ModuleCompleteStatus::where('batch', $request->batch)->orderByDesc('status')->get();
        if($modules->isEmpty()):
            $modules = CourseModule::whereIn('course', BatchCourse::where('batch_id', $request->batch)->pluck('course_id'))->get();
        endif;
        $exam = Exam::where('batch_id', $request->batch)->where('exam_type', 7)->pluck('id');
        $topics = Question::leftJoin('topics as t', 'questions.topic_id', 't.id')->whereIn('questions.id', ExamQuestion::whereIn('exam_id', $exam)->pluck('question_id'))->groupBy('t.name')->pluck('t.name')->implode(',');
        return view('admin.module.index', compact('batches', 'modules', 'faculties', 'batch', 'topics'));
    }

    public function savemodule(Request $request){
        DB::transaction(function() use ($request) {
            $data = [];
            foreach($request->modules as $key => $value):
                $data [] = [
                    'batch' => $request->batch,
                    'module' => $value,
                    'faculty' => $request->faculties[$key],
                    'status' => $request->statuses[$key],
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            endforeach;
            ModuleCompleteStatus::where('batch', $request->batch)->delete();
            ModuleCompleteStatus::insert($data);
        });
        return redirect()->route('module.status.show')->with('success', 'Module Status Updated Successfully!');
    }

    public function deletemodule($id){
        ModuleCompleteStatus::find($id)->delete();
        return redirect()->route('module.status.show')->with('success', 'Module Deleted Successfully!');
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
