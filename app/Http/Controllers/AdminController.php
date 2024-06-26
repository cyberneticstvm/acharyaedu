<?php

namespace App\Http\Controllers;

use App\Models\AdmissionFee;
use App\Models\Attendance;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Income;
use App\Models\ModuleCompleteStatus;
use App\Models\Settings;
use App\Models\Student;
use App\Models\StudentBatch;
use App\Models\Syllabus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminController extends Controller
{
    public function dash()
    {
        $user = Auth::user();
        if ($user->role == 'Admin') :
            $afee = Student::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('admission_fee_advance');
            $afeeb = AdmissionFee::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
            $bfee = Fee::whereMonth('paid_date', Carbon::now()->month)->whereYear('paid_date', Carbon::now()->year)->sum('fee_advance');
            $income = Income::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
            $expense = Expense::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
            $income = $afee + $afeeb + $bfee + $income;
            $profit = $income - $expense;
            $students_active = StudentBatch::where('cancelled', 0)->count(DB::raw('DISTINCT student'));
            return view('admin.admin-dash-demo', compact('income', 'expense', 'profit', 'students_active'));
        elseif ($user->role == 'Staff') :
            return view('admin.staff-dash');
        //return redirect()->route('staff.dash')->with("success", "User logged in successfully!");
        else :
            return view('student.dash');
        //return redirect()->route('student.dash')->with("success", "User logged in successfully!");
        endif;
    }

    public function dashdemo()
    {
        $afee = Student::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('admission_fee_advance');
        $afeeb = AdmissionFee::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $bfee = Fee::whereMonth('paid_date', Carbon::now()->month)->whereYear('paid_date', Carbon::now()->year)->sum('fee_advance');
        $income = Income::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $expense = Expense::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $income = $afee + $afeeb + $bfee + $income;
        $profit = $income - $expense;
        $students_active = StudentBatch::where('cancelled', 0)->count(DB::raw('DISTINCT student'));
        return view('admin.admin-dash', compact('income', 'expense', 'profit', 'students_active'));
    }

    public function show()
    {
        $branch = Auth::user()->branch;
        $settings = Settings::where('branch', $branch)->first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $branch = Auth::user()->branch;
        $this->validate($request, [
            'admin_name' => 'required|unique:settings,admin_name,' . $id,
            'admin_email' => 'required|email:filter|unique:settings,admin_email,' . $id,
            'batch_fee_discount_percentage' => 'required|numeric',
        ]);
        $input = $request->except(array('_method', '_token'));
        $input['branch'] = $branch;
        Settings::upsert($input, ['branch']);
        return redirect()->route('settings.show')->with('success', 'Settings Updated Successfully!');
    }

    public function getDropDown(Request $request)
    {
        $id = $request->bid;
        $syls = DB::table('batch_syllabs')->select('syllabus')->where('batch', $id)->pluck('syllabus');
        $data = Syllabus::whereIn('id', $syls)->select('id', 'name')->get();
        $op = "<option value=''>Select</option>";
        foreach ($data as $key => $val) :
            $op .= "<option value='" . $val->id . "'>" . $val->name . "</option>";
        endforeach;
        echo $op;
    }

    public function studentregchart()
    {
        $students = DB::select("SELECT date, CONCAT_WS('-', SUBSTRING(MONTHNAME(date), 1, 3), DATE_FORMAT(date, '%y')) AS mname, COUNT(s.id) AS ptot FROM (
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS date UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 8 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 9 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 10 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 11 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 12 MONTH
		) AS dates
		LEFT JOIN students s ON s.created_at >= date AND s.created_at < date + INTERVAL 1 MONTH GROUP BY date");
        return json_encode($students);
    }

    public function studentfeechart()
    {
        $afee = Student::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('fee');
        $bfee = Fee::whereMonth('paid_date', Carbon::now()->month)->whereYear('paid_date', Carbon::now()->year)->sum('fee');
        $income = Income::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $expenses = Expense::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        return array('afee' => $afee, 'bfee' => $bfee, 'income' => $income, 'expense' => $expenses);
    }

    public function studentcancelledchart()
    {
        $students = DB::select("SELECT date, CONCAT_WS('-', SUBSTRING(MONTHNAME(date), 1, 3), DATE_FORMAT(date, '%y')) AS mname, COUNT(CASE WHEN s.cancelled = 1 THEN s.id END) AS ptot FROM (
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS date UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 8 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 9 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 10 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 11 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 12 MONTH
		) AS dates
		LEFT JOIN student_batches s ON s.created_at >= date AND s.created_at < date + INTERVAL 1 MONTH GROUP BY date");
        return json_encode($students);
    }

    public function leaves()
    {
        $attendance = Attendance::where('leave', 1)->orderByDesc('date')->get();
        return view('admin.student.leaves', compact('attendance'));
    }

    public function deleteRecord(Request $request)
    {
        $id = $request->id;
        $model = $request->model;
        if ($model == 'module-status') :
            ModuleCompleteStatus::findOrFail($id)->delete();
        endif;
        echo "Record deleted successfully";
    }
}
