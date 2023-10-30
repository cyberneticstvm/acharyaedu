<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\GeneralQuestion;
use App\Models\GeneralQuestionCourse;
use App\Models\Subject;
use Exception;
use DB;
use Illuminate\Http\Request;

class GeneralQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = GeneralQuestion::latest()->get();
        $courses = Course::all();
        return view('admin.question-general.index', compact('questions', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $subjects = Subject::where('exam_type', 1)->get();
        return view('admin.question-general.create', compact('courses', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'array|present',
            'subject_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $gq = GeneralQuestion::create([
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'explanation' => $request->explanation,
                    'subject_id' => $request->subject_id,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ]);
                foreach ($request->course_id as $key => $course) :
                    $data[] = [
                        'question_id' => $gq->id,
                        'course_id' => $course,
                    ];
                endforeach;
                GeneralQuestionCourse::insert($data);
            });
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('question.general')->with("success", "Question added successfully!");
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
        $courses = Course::all();
        $subjects = Subject::where('exam_type', 1)->get();
        $question = GeneralQuestion::findOrFail(decrypt($id));
        return view('admin.question-general.edit', compact('courses', 'subjects', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'course_id' => 'array|present',
            'subject_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                GeneralQuestion::findOrFail($id)->update([
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'explanation' => $request->explanation,
                    'subject_id' => $request->subject_id,
                    'updated_by' => $request->user()->id,
                ]);
                foreach ($request->course_id as $key => $course) :
                    $data[] = [
                        'question_id' => $id,
                        'course_id' => $course,
                    ];
                endforeach;
                GeneralQuestionCourse::where('question_id', $id)->delete();
                GeneralQuestionCourse::insert($data);
            });
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('question.general')->with("success", "Question updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        GeneralQuestion::findOrFail($id)->delete();
        return redirect()->route('question.general')->with("success", "Question deleted successfully!");
    }
}
