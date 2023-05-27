<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\ClassSchedule;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::where('email', Auth::user()->email)->first();
        $classes = ClassSchedule::whereDate('class_date', '>=',Carbon::today())->get();
        return view('admin.class-schedule.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all(); $faculties = Faculty::all(); $batches = Batch::where('status', 1)->get();
        return view('admin.class-schedule.create', compact('subjects', 'faculties', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'class_date' => 'required',
            'batch_id' => 'required',
            'subject_id' => 'required',
            'faculty_id' => 'required',
            'class_time' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;        
        $input['updated_by'] = $request->user()->id;               
        ClassSchedule::create($input);
        return redirect()->route('cschedule')->with('success', 'Class Scheduled Successfully!');
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
        $subjects = Subject::all(); $faculties = Faculty::all(); $batches = Batch::where('status', 1)->get();
        $class = ClassSchedule::find(decrypt($id));
        return view('admin.class-schedule.edit', compact('subjects', 'faculties', 'batches', 'class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'class_date' => 'required',
            'batch_id' => 'required',
            'subject_id' => 'required',
            'faculty_id' => 'required',
            'class_time' => 'required',
        ]);
        $input = $request->all();       
        $input['updated_by'] = $request->user()->id;               
        $class = ClassSchedule::find($id);
        $class->update($input);
        return redirect()->route('cschedule')->with('success', 'Class Rescheduled Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ClassSchedule::find($id)->delete();
        return redirect()->route('cschedule')->with('success', 'Class scheduled deleted successfully.');
    }
}
