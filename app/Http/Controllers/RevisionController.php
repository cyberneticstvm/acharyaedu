<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Revision;
use App\Models\RevisionModule;
use App\Models\Subject;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revisions = Revision::all();
        return view('admin.revision.index', compact('revisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('status', 1)->get(); $modules = Topic::all(); $subjects = Subject::all();
        return view('admin.revision.create', compact('batches', 'modules', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'modules' => 'present|array',
            'title' => 'required',
            'batch_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        DB::transaction(function() use ($request) {
            $data = []; $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $revision = Revision::create($input);
            foreach($request->modules as $key => $module):
                $data [] = [
                    'module_id' => $module,
                    'revision_id' => $revision->id,
                ];
            endforeach;
            RevisionModule::insert($data);
        });
        return redirect()->route('revision')->with('success', 'Revision Saved Successfully!');
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
        $revision = Revision::find(decrypt($id));
        $batches = Batch::where('status', 1)->get(); $modules = Topic::all(); $subjects = Subject::all();
        return view('admin.revision.edit', compact('subjects', 'modules', 'batches', 'revision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'modules' => 'present|array',
            'title' => 'required',
            'batch_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        DB::transaction(function() use ($request, $id) {
            $data = []; $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            $revision = Revision::find($id);
            $revision->update($input);
            foreach($request->modules as $key => $module):
                $data [] = [
                    'module_id' => $module,
                    'revision_id' => $revision->id,
                ];
            endforeach;
            RevisionModule::where('revision_id', $id)->delete();
            RevisionModule::insert($data);
        });
        return redirect()->route('revision')->with('success', 'Revision Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Revision::find($id)->delete();
        return redirect()->route('revision')->with('success', 'Revision Deleted Successfully!');
    }
}
