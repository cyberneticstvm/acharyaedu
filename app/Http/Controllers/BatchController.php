<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Syllabus;
use DB;
use Exception;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();
        $syllabus = Syllabus::all();
        return view('admin.batch.index', compact('batches', 'syllabus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $syllabi = Syllabus::all();
        return view('admin.batch.create', compact('courses', 'syllabi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'batch_type' => 'required',
            'name' => 'required|unique:batches,name',
            'courses' => 'present|array',
            'fee' => 'required',
            'syllabi' => 'present|array',
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;        
        $input['updated_by'] = Auth::user()->id;
        $input['course'] = 0;
        
        try{
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::transaction(function() use ($input, $request) { 
                $batch = Batch::create($input);           
                foreach($request->syllabi as $key => $syl):
                    $data [] = [
                        'syllabus' => $syl,
                        'batch' => $batch->id,
                    ];
                endforeach;
                foreach($request->courses as $key => $course):
                    $courses [] = [
                        'batch_id' => $batch->id,
                        'course_id' => $course,
                    ];
                endforeach;
                DB::table('batch_syllabs')->insert($data);
                DB::table('batch_courses')->insert($courses);
            });
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }catch(Exception $e){
            throw $e;
            return redirect()->back()->with('error', $e->getMessage());
        }               
        return redirect()->route('batch')->with('success', 'Batch Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::all();
        $batch = Batch::find($id);
        $syllabi = Syllabus::all();
        $syls = DB::table('batch_syllabs')->where('batch', $id)->get();
        return view('admin.batch.edit', compact('courses', 'batch', 'syllabi', 'syls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'batch_type' => 'required',
            'name' => 'required|unique:batches,name,'.$id,
            'courses' => 'present|array',
            'fee' => 'required',
            'syllabi' => 'present|array',
        ]);
        $input = $request->all();       
        $input['updated_by'] = Auth::user()->id;        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        try{
            DB::transaction(function() use ($input, $request, $id) { 
                $batch = Batch::find($id);        
                $batch->update($input);           
                DB::table('batch_syllabs')->where('batch', $id)->delete();
                DB::table('batch_courses')->where('batch_id', $id)->delete();
                foreach($request->syllabi as $key => $syl):
                    $data [] = [
                        'syllabus' => $syl,
                        'batch' => $batch->id,
                    ];
                endforeach;
                foreach($request->courses as $key => $course):
                    $courses [] = [
                        'batch_id' => $batch->id,
                        'course_id' => $course,
                    ];
                endforeach;
                DB::table('batch_syllabs')->insert($data);
                DB::table('batch_courses')->insert($courses);
            });
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }catch(Exception $e){
            throw $e;
            return redirect()->back()->with('error', $e->getMessage());
        }          
        return redirect()->route('batch')->with('success', 'Batch Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Batch::find($id)->delete();
        return redirect()->route('batch')->with('success', 'Batch Deleted Successfully!');
    }
}
