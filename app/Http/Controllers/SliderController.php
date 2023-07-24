<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'order' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('image')):
            $img = $request->file('image');
            $fname = 'sliders/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['image'] = $img->getClientOriginalName();                                 
        endif;
        try{
            Slider::create($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }        
        return redirect()->route('slider')->with('success', 'Slider Created Successfully!');
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
        $slider = Slider::find(decrypt($id));
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'order' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('image')):
            $img = $request->file('image');
            $fname = 'sliders/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['image'] = $img->getClientOriginalName();                                 
        endif;
        try{
            $slider = Slider::find($id);
            $slider->update($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }        
        return redirect()->route('slider')->with('success', 'Slider Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slider::find($id)->delete();
        return redirect()->route('slider')->with('success', 'Slider Deleted Successfully!');
    }
}
