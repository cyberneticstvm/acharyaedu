<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Fee;
use App\Models\Month;
use App\Models\Expense;
use App\Models\Head;
use App\Models\Student;
use App\Models\StudentBatch;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function daybook()
    {
        $fee = collect();
        $income = collect();
        $expense = collect();
        $inputs = [];
        $students = collect();
        return view('admin.reports.daybook', compact('fee', 'income', 'expense', 'inputs', 'students'));
    }

    public function fetchdaybook(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
        ]);
        $inputs = array($request->date);
        $fee = Fee::whereDate('paid_date', $request->date)->get();
        $students = Student::whereDate('created_at', $request->date)->where('admission_fee_advance', '>', 0)->get();
        $income = Income::whereDate('date', $request->date)->get();
        $expense = Expense::whereDate('date', $request->date)->get();
        return view('admin.reports.daybook', compact('fee', 'income', 'expense', 'inputs', 'students'));
    }

    public function dailyClosing()
    {
        $fee = collect();
        $income = collect();
        $expense = collect();
        $inputs = [];
        $students = collect();
        $closing_balance = 0;
        $opening_balance = 0;
        return view('admin.reports.daily-closing', compact('opening_balance', 'fee', 'income', 'expense', 'inputs', 'students', 'closing_balance'));
    }

    public function fetchDailyClosing(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $inputs = array($request->from_date, $request->to_date);
        $prev_day = Carbon::parse($request->from_date)->startOfDay()->subDays(1);

        $opening_balance = DB::table('daily_closings as d')->select(DB::raw("MAX(d.id), IFNULL(d.closing_balance, 0) AS closing_balance"))->whereDate('d.date', '=', $prev_day)->orderByDesc('d.id')->first()->closing_balance;

        $fee = Fee::whereBetween('paid_date', [$request->from_date, $request->to_date])->get();
        $students = Student::whereBetween('created_at', [$request->from_date, $request->to_date])->whereRaw("CASE WHEN admission_fee_advance > 0 THEN admission_fee_advance ELSE fee END")->get();
        $income = Income::whereBetween('date', [$request->from_date, $request->to_date])->get();
        $expense = Expense::whereBetween('date', [$request->from_date, $request->to_date])->get();

        $closing_balance = ($opening_balance + $students->sum('admission_fee_advance') + $fee->sum('fee_advance') + $income->sum('amount')) - $expense->sum('amount');
        return view('admin.reports.daily-closing', compact('opening_balance', 'fee', 'income', 'expense', 'inputs', 'students', 'closing_balance'));
    }

    public function fee()
    {
        $records = collect();
        $inputs = [];
        return view('admin.reports.fee', compact('records', 'inputs'));
    }

    public function fetchfee(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $records = Fee::whereBetween('paid_date', [$request->from_date, $request->to_date])->get();
        $inputs = array($request->from_date, $request->to_date);
        return view('admin.reports.fee', compact('records', 'inputs'));
    }

    public function feepending()
    {
        $records = collect();
        $inputs = [];
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        return view('admin.reports.fee-pending', compact('records', 'batches', 'months', 'years', 'inputs'));
    }

    public function fetchfeepending(Request $request)
    {
        $this->validate($request, [
            'batch' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        $inputs = array($request->batch, $request->month, $request->year);
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        $records = StudentBatch::where('batch', $request->batch)->where('cancelled', 0)->whereMonth('date_joined', '<=', $request->month)->whereYear('date_joined', '<=', $request->year)->get();
        return view('admin.reports.fee-pending', compact('records', 'batches', 'months', 'years', 'inputs'));
    }

    public function attendance()
    {
        $records = collect();
        $inputs = [];
        $days = 0;
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        return view('admin.reports.attendance', compact('records', 'batches', 'months', 'years', 'inputs', 'days'));
    }

    public function fetchattendance(Request $request)
    {
        $this->validate($request, [
            'batch' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        $inputs = array($request->batch, $request->month, $request->year);
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        $records = StudentBatch::where('batch', $request->batch)->where('cancelled', 0)->get();
        return view('admin.reports.attendance', compact('records', 'batches', 'months', 'years', 'inputs', 'days'));
    }

    public function student()
    {
        $student = [];
        $batches = [];
        $records = [];
        $inputs = [];
        return view('admin.reports.student', compact('student', 'inputs', 'batches', 'records'));
    }

    public function fetchstudent(Request $request)
    {
        $this->validate($request, [
            'student' => 'required',
        ]);
        $student = Student::find($request->student);
        if ($student) :
            $batches = Batch::whereIn('id', $student->batches()->pluck('batch'))->pluck('name')->implode(', ');
            $records = StudentBatch::whereIn('batch', $student->batches()->pluck('batch'))->where('student', $request->student)->get();
            $inputs = array($request->student);
            return view('admin.reports.student', compact('student', 'inputs', 'batches', 'records'));
        else :
            return redirect()->back()->with("error", "Student details not found")->withInput($request->all);
        endif;
    }

    public function attendancesummary()
    {
        $inputs = [];
        $att = collect();
        $batches = Batch::where('status', 1)->get();
        return view('admin.reports.attendance-summary', compact('inputs', 'att', 'batches'));
    }

    public function fetchattendancesummary(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'batch' => 'required',
        ]);
        $inputs = array($request->batch, $request->date);
        $batches = Batch::where('status', 1)->get();
        $att = Attendance::whereDate('date', $request->date)->where('batch', $request->batch)->get();
        return view('admin.reports.attendance-summary', compact('inputs', 'att', 'batches'));
    }

    public function ie()
    {
        $inputs = [];
        $ies = collect();
        $heads = Head::all();
        return view('admin.reports.ie', compact('inputs', 'ies', 'heads'));
    }

    public function iefetch(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
            'type' => 'required',
            'head' => 'required',
        ]);
        $inputs = array($request->from_date, $request->to_date, $request->type, $request->head);
        $heads = Head::all();
        if ($request->type == 'Income') :
            $ies = Income::whereBetween('date', [$request->from_date, $request->to_date])->where('head', $request->head)->get();
        else :
            $ies = Expense::whereBetween('date', [$request->from_date, $request->to_date])->where('head', $request->head)->get();
        endif;
        return view('admin.reports.ie', compact('inputs', 'ies', 'heads'));
    }
}
