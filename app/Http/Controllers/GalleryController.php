<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = Gallery::orderByDesc('id')->get();
        return view('admin.gallery.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $gallery = Gallery::create($input);        
        if($request->hasFile('attachment')):
            $f = $request->file('attachment');
            $fname = 'gallery/'.$gallery->id.'/'.$f->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $f, '');
            Gallery::where('id', $gallery->id)->update(['attachment' => $fname]);                                
        endif;
        return redirect()->route('gallery')->with('success', 'Gallery created successfully');        
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
        $gallery = Gallery::find(decrypt($id));
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        $gallery = Gallery::find($id);        
        if($request->hasFile('attachment')):
            $f = $request->file('attachment');
            $fname = 'gallery/'.$gallery->id.'/'.$f->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $f, '');
            $input['attachment'] = $fname;                                
        endif;
        $gallery->update($input);
        return redirect()->route('gallery')->with('success', 'Gallery updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gallery::find($id)->delete();
        return redirect()->route('gallery')->with('success', 'Gallery deleted successfully');
    }
}
