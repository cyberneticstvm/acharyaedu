<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CurrentAffair;
use Illuminate\Http\Request;

class CurrentAffairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caffairs = CurrentAffair::orderByDesc('date')->get();
        return view('admin.caffair.index', compact('caffairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.caffair.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'date' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;        
        $input['updated_by'] = Auth::user()->id;        
        CurrentAffair::create($input);
        return redirect()->route('caffair')->with('success', 'Record Created Successfully!');
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
        $caffair = CurrentAffair::find(decrypt($id));
        return view('admin.caffair.edit', compact('caffair'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'date' => 'required',
        ]);
        $input = $request->all();      
        $input['updated_by'] = Auth::user()->id;        
        $caffair = CurrentAffair::find($id);
        $caffair->update($input);
        return redirect()->route('caffair')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CurrentAffair::find($id)->delete();
        return redirect()->route('caffair')->with('success', 'Record Deleted Successfully!');
    }
}
