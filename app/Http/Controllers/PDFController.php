<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Fee;
use App\Models\StudentBatch;
use Carbon\Carbon;
use Mail;
use PDF;
use DB;

class PDFController extends Controller
{
    public function admissionfee($id)
    {
        $student = Student::find($id);
        $pdf = PDF::loadView('/admin/PDFs/admission-fee', compact('student'));
        return $pdf->stream($student->name . '.pdf', array("Attachment" => 0));
    }

    public function emailadmissionfee($id)
    {
        $student = Student::find($id);
        $pdf = PDF::loadView('/admin/PDFs/admission-fee', compact('student'));
        Mail::send('admin.email.admission-fee-receipt', ['student' => $student], function ($message) use ($student, $pdf) {
            $message->to($student->email, $student->name)
                ->subject("Admission Fee Receipt - Acharya")
                ->attachData($pdf->output(), $student->name . ".pdf");
        });
        return redirect()->back()->with('success', 'Receipt emailed successfully!');
    }

    public function batchfee($id)
    {
        $fee = Fee::find($id);
        $pdf = PDF::loadView('/admin/PDFs/batch-fee', compact('fee'));
        return $pdf->stream($fee->student()->find($fee->student)->name . '.pdf', array("Attachment" => 0));
    }

    public function emailbatchfee($id)
    {
        $fee = Fee::find($id);
        $pdf = PDF::loadView('/admin/PDFs/batch-fee', compact('fee'));
        Mail::send('admin.email.batch-fee-receipt', ['fee' => $fee], function ($message) use ($fee, $pdf) {
            $message->to($fee->student()->find($fee->student)->email, $fee->student()->find($fee->student)->name)
                ->subject("Batch Fee Receipt - Acharya")
                ->attachData($pdf->output(), $fee->student()->find($fee->student)->name . ".pdf");
        });
        return redirect()->back()->with('success', 'Receipt emailed successfully!');
    }

    public function pendingFee($batch, $month, $year)
    {
        $date = Carbon::createFromDate($year, $month, 1)->copy()->startOfMonth();;
        $batch = Batch::findOrFail($batch);
        $monthname = Carbon::createFromFormat('m', $month)->monthName;
        $records = StudentBatch::where('batch', $batch->id)->where('cancelled', 0)->whereDate('date_joined', '>=', $date)->get();
        $pdf = PDF::loadView('/admin/PDFs/pending-fee', compact('records', 'batch', 'monthname', 'year', 'month'));
        return $pdf->stream('pending-fee.pdf', array("Attachment" => 0));
    }
}
