<?php

namespace App\Http\Controllers;

use App\Models\AdmissionFee;
use App\Models\Batch;
use App\Models\PaymentMode;
use App\Models\Student;
use Illuminate\Http\Request;

class AdmissionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = AdmissionFee::latest()->get();
        return view('admin.fee.admission.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('status', 1)->get();
        $pmodes = PaymentMode::all();
        return view('admin.fee.admission.create', compact('batches', 'pmodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'batch_id' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
        ]);
        $input = $request->all();
        $student = Student::find($request->student_id);
        if ($student) :
            AdmissionFee::create($input);
            return redirect()->route('admission.fee')->with('success', 'Admission Fee Updated Successfully!');
        else :
            return redirect()->route('admission.fee')->with('error', 'Student Id not found!');
        endif;
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
        $fee = AdmissionFee::findOrFail($id);
        $batches = Batch::where('status', 1)->get();
        $pmodes = PaymentMode::all();
        return view('admin.fee.admission.edit', compact('batches', 'pmodes', 'fee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'batch_id' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
        ]);
        $input = $request->all();
        $student = Student::find($request->student_id);
        if ($student) :
            AdmissionFee::findOrFail($id)->update($input);
            return redirect()->route('admission.fee')->with('success', 'Admission Fee Updated Successfully!');
        else :
            return redirect()->route('admission.fee')->with('error', 'Student Id not found!');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AdmissionFee::findOrFail($id)->delete();
        return redirect()->route('admission.fee')->with('success', 'Fee Deleted Successfully!');
    }
}
