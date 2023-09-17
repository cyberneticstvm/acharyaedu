<?php

namespace App\Console;

use App\Models\Exam;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Income;
use App\Models\Student;
use App\Models\StudentExam;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $exams = Exam::whereDate('exam_date', Carbon::today())->get();
            foreach($exams as $key => $exam):
                $studentexams = StudentExam::where('exam_id', $exam->id)->orderByDesc('total_mark_after_cutoff')->get();
                foreach($studentexams as $key1 => $sxam):
                    StudentExam::where('id', $sxam->id)->update(['grade' => $key1+1]);
                endforeach;
            endforeach;
        })->dailyAt('23:30');

        $schedule->call(function () {
            $closing_balance = $this->getclosingBalance();
            DB::table('daily_closings')->insert(
                ['date' => Carbon::today(), 'closing_balance' => $closing_balance, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );
        })->dailyAt('23:30');
    }

    private function getClosingBalance(){

        $opening_balance = DB::table('daily_closings as d')->select(DB::raw("MAX(d.id), IFNULL(d.closing_balance, 0) AS closing_balance"))->whereDate('d.date', '=', Carbon::today()->subDays(1))->orderByDesc('d.id')->first()->closing_balance;

        $admission_fee = Student::whereDate('created_at', Carbon::today())->sum('admission_fee_advance');
        $batch_fee = Fee::whereDate('paid_date', Carbon::today())->sum('fee_advance');
        $income = Income::whereDate('date', Carbon::today())->sum('amount');
        $expense = Expense::whereDate('date', Carbon::today())->sum('amount');
        return ($opening_balance + $admission_fee + $batch_fee + $income) - $expense;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
