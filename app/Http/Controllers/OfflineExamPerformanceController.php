<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\OfflineExampPerformance;
use Illuminate\Http\Request;

class OfflineExamPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oeps = OfflineExampPerformance::latest()->get();
        return view('admin.oep.index', compact('oeps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('status', 1)->get();
        return view('admin.oep.create', compact('batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'exam_name' => 'required',
            'batch_id' => 'required',
            'exam_date' => 'required',
            'total_mark' => 'required',
            'mark_scored' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['performance'] = ($request->mark_scored / $request->total_mark) * 100;
        OfflineExampPerformance::create($input);
        return redirect()->route('oep')->with('success', 'Record Saved Successfully!');
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
        $oep = OfflineExampPerformance::findOrFail($id);
        $batches = Batch::where('status', 1)->get();
        return view('admin.oep.edit', compact('batches', 'oep'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'exam_name' => 'required',
            'batch_id' => 'required',
            'exam_date' => 'required',
            'total_mark' => 'required',
            'mark_scored' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        $input['performance'] = ($request->mark_scored / $request->total_mark) * 100;
        $oep = OfflineExampPerformance::findOrFail($id);
        $oep->update($input);
        return redirect()->route('oep')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OfflineExampPerformance::find($id)->delete();
        return redirect()->route('oep')->with('success', 'Record Deleted Successfully!');
    }
}
