<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::when(Auth::user()->student, function($query){
            return $query->whereDate('exam_date', '>=', Auth::user()->student->admission_date);
        })->orderByDesc('exam_date')->get();
        $batches = Batch::where('status', 1)->get();
        return view('admin.exam.index', compact('exams', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('status', 1)->get(); $etypes = ExamType::all();
        return view('admin.exam.create', compact('batches', 'etypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'exam_type' => 'required',
            'name' => 'required|unique:exams,name',
            'batch_id' => 'required',
            'cut_off_mark' => 'required',
            'question_count' => 'required',
            'exam_date' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;               
        $input['updated_by'] = $request->user()->id;
        $input['exam_date'] = Carbon::parse($request->exam_date)->startOfDay();               
        try{
            Exam::create($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('exam')->with('success', 'Exam Created Successfully!');
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
        $exam = Exam::find($id);
        $batches = Batch::where('status', 1)->get(); $etypes = ExamType::all();
        return view('admin.exam.edit', compact('exam', 'batches', 'etypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'exam_type' => 'required',
            'name' => 'required|unique:exams,name,'.$id,
            'batch_id' => 'required',
            'cut_off_mark' => 'required',
            'question_count' => 'required',
            'exam_date' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();             
        $input['updated_by'] = $request->user()->id;
        $input['exam_date'] = Carbon::parse($request->exam_date)->startOfDay();               
        try{
            $exam = Exam::find($id);
            $exam->update($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('exam')->with('success', 'Exam Updated Successfully!');
    }

    public function assign(string $id){
        $exam = Exam::find($id);
        $batches = Batch::where('status', 1)->where('id', '!=', $exam->batch_id)->get(); $etypes = ExamType::all();
        return view('admin.exam.assign', compact('exam', 'batches', 'etypes'));
    }

    public function assignsave(Request $request){
        $this->validate($request, [
            'exam_type' => 'required',
            'name' => 'required|unique:exams,name',
            'batch_id' => 'required',
            'cut_off_mark' => 'required',
            'question_count' => 'required',
            'exam_date' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;               
        $input['updated_by'] = $request->user()->id;
        $input['exam_date'] = Carbon::parse($request->exam_date)->startOfDay();               
        try{
            $exam = Exam::create($input);
            $questions = ExamQuestion::where('exam_id', $request->exam_id)->get();
            //dd($questions);
            //die;
            foreach($questions as $key => $value):
                $data [] = [
                    'exam_id' => $exam->id,
                    'question_id' => $value->question_id,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ];
            endforeach;
            ExamQuestion::insert($data);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('exam')->with('success', 'Exam Assigned Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Exam::find($id)->delete();
        return redirect()->route('exam')->with('success', 'Exam Deleted Successfully!');
    }
}
