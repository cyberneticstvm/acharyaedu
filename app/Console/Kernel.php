<?php

namespace App\Console;

use App\Models\Exam;
use App\Models\StudentExam;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
