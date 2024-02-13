<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use App\Models\OfflineExam;
use App\Models\StudentBatch;
use App\Models\StudentOfflineExam;
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
        $exams = Exam::when(Auth::user()->student, function ($query) {
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
        $batches = Batch::where('status', 1)->get();
        $etypes = ExamType::all();
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
        try {
            Exam::create($input);
        } catch (Exception $e) {
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
        $batches = Batch::where('status', 1)->get();
        $etypes = ExamType::all();
        return view('admin.exam.edit', compact('exam', 'batches', 'etypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'exam_type' => 'required',
            'name' => 'required|unique:exams,name,' . $id,
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
        try {
            $exam = Exam::find($id);
            $exam->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('exam')->with('success', 'Exam Updated Successfully!');
    }

    public function assign(string $id)
    {
        $exam = Exam::find($id);
        $batches = Batch::where('status', 1)->where('id', '!=', $exam->batch_id)->get();
        $etypes = ExamType::all();
        return view('admin.exam.assign', compact('exam', 'batches', 'etypes'));
    }

    public function assignsave(Request $request)
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
        try {
            $exam = Exam::create($input);
            $questions = ExamQuestion::where('exam_id', $request->exam_id)->get();
            //dd($questions);
            //die;
            foreach ($questions as $key => $value) :
                $data[] = [
                    'exam_id' => $exam->id,
                    'question_id' => $value->question_id,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ];
            endforeach;
            ExamQuestion::insert($data);
        } catch (Exception $e) {
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

    public function examSettings()
    {
        $etypes = ExamType::all();
        return view('admin.settings.exam', compact('etypes'));
    }

    public function examSettingsEdit($id)
    {
        $batches = Batch::where('status', 1)->get();
        $etype = ExamType::findOrFail($id);
        return view('admin.settings.exam-edit', compact('batches', 'etype'));
    }

    public function examSettingsUpdate(Request $request, string $id)
    {
        $this->validate($request, [
            'batch_id' => 'required',
            'cut_off_mark' => 'required',
            'question_count' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);
        try {
            ExamType::where('id', $id)->update(['batch_id' => $request->batch_id, 'cut_off_mark' => $request->cut_off_mark, 'question_count' => $request->question_count, 'exam_duration' => $request->duration, 'status' => $request->status]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('admin.exam.setting')->with('success', 'Exam Settings Updated Successfully!');
    }

    public function offlineExamRegister()
    {
        $exams = OfflineExam::latest()->get();
        $batches = Batch::where('status', 1)->get();
        return view('admin.exam.offline.index', compact('exams', 'batches'));
    }

    public function offlineExamForm()
    {
        $batches = Batch::where('status', 1)->get();
        return view('admin.exam.offline.create', compact('batches'));
    }

    public function offlineExamSave(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'batch_id' => 'required',
            'total_mark' => 'required',
            'cut_off_mark' => 'required',
            'question_count' => 'required',
            'exam_date' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $students = StudentBatch::where('batch', $request->batch_id)->where('cancelled', 0)->get();
        try {
            $exam = OfflineExam::create($input);
            $data = [];
            foreach ($students as $key => $student) :
                $data[] = [
                    'exam_id' => $exam->id,
                    'student_id' => $student->id,
                    'correct_answer_count' => 0,
                    'wrong_answer_count' => 0,
                    'unattended_count' => 0,
                    'total_mark' => $exam->total_mark,
                    'cutoff_mark' => $exam->cutoff_mark,
                    'total_mark_after_cutoff' => 0,
                    'grade' => $exam->grade,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            endforeach;
            StudentOfflineExam::insert($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('admin.offline.exam.register')->with('success', 'Exam Created Successfully!');
    }

    public function offlineExamDelete(string $id)
    {
        OfflineExam::find($id)->delete();
        return redirect()->route('admin.offline.exam.register')->with('success', 'Exam Deleted Successfully!');
    }
}
