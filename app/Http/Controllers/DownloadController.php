<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DocumentType;
use App\Models\Download;
use App\Models\DownloadModule;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = Download::all();
        return view('admin.docs.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::all();
        $subjects = Subject::where('exam_type', 6)->get();
        $modules = Topic::all(); $doctypes = DocumentType::all();
        return view('admin.docs.create', compact('batches', 'subjects', 'modules', 'doctypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'batch_id' => 'required',
            'subject_id' => 'required',
            'attachment' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx',
            'modules' => 'array|present',
            'document_type' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        try{
            $modules = [];
            $download = Download::create($input);
            foreach($request->modules as $key => $module):
                $modules[] = [
                    'download_id' => $download->id,
                    'module_id' => $module,
                ];
            endforeach;
            DownloadModule::insert($modules);
            if($request->hasFile('attachment')):
                $f = $request->file('attachment');
                $fname = 'downloads/'.$download->id.'/'.$f->getClientOriginalName();
                Storage::disk('public')->putFileAs($fname, $f, '');
                Download::where('id', $download->id)->update(['attachment' => $fname]);                                
            endif;
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('docs')->with('success', 'Doc created successfully');
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
        $batches = Batch::all(); $doc = Download::find(decrypt($id));
        $subjects = Subject::where('exam_type', 6)->get();
        $modules = Topic::all(); $doctypes = DocumentType::all();
        return view('admin.docs.edit', compact('batches', 'subjects', 'modules', 'doctypes', 'doc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'batch_id' => 'required',
            'subject_id' => 'required',
            'modules' => 'array|present',
            'document_type' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            $modules = [];
            $download = Download::find($id);
            $download->update($input);
            foreach($request->modules as $key => $module):
                $modules[] = [
                    'download_id' => $download->id,
                    'module_id' => $module,
                ];
            endforeach;
            DownloadModule::where('download_id', $download->id)->delete();
            DownloadModule::insert($modules);
            if($request->hasFile('attachment')):
                $f = $request->file('attachment');
                $fname = 'downloads/'.$download->id.'/'.$f->getClientOriginalName();
                Storage::disk('public')->putFileAs($fname, $f, '');
                Download::where('id', $download->id)->update(['attachment' => $fname]);                                
            endif;
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('docs')->with('success', 'Doc updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Download::find($id)->delete();
        return redirect()->route('docs')->with('success', 'Doc deleted successfully');
    }
}
