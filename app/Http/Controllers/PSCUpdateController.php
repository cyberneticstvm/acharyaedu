<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\PscUpdate;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class PSCUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = PscUpdate::all();
        return view('admin.psc.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $months = Month::all();
        $years = Year::all();
        return view('admin.psc.create', compact('months', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'attachment' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx',
            'pmonth' => 'required',
            'pyear' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        try{
            $psc = PscUpdate::create($input);
            if($request->hasFile('attachment')):
                $f = $request->file('attachment');
                $fname = 'psc/'.$psc->id.'/'.$f->getClientOriginalName();
                Storage::disk('public')->putFileAs($fname, $f, '');
                PscUpdate::where('id', $psc->id)->update(['attachment' => $fname]);                                
            endif;
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('psc')->with('success', 'PSC Update created successfully');
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
        $months = Month::all(); $psc = PscUpdate::find(decrypt($id));
        $years = Year::all();
        return view('admin.psc.edit', compact('months', 'years', 'psc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'pmonth' => 'required',
            'pyear' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            $psc = PscUpdate::find($id);
            $psc->update($input);
            if($request->hasFile('attachment')):
                $f = $request->file('attachment');
                $fname = 'psc/'.$psc->id.'/'.$f->getClientOriginalName();
                Storage::disk('public')->putFileAs($fname, $f, '');
                PscUpdate::where('id', $psc->id)->update(['attachment' => $fname]);                                
            endif;
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('psc')->with('success', 'PSC Update updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PscUpdate::find($id)->delete();
        return redirect()->route('psc')->with('success', 'PSC Update deleted successfully');
    }
}
