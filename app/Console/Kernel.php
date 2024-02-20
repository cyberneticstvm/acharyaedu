<?php

namespace App\Console;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Income;
use App\Models\OfflineExam;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentBatch;
use App\Models\StudentExam;
use App\Models\StudentOfflineExam;
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
            $batches = Batch::where('status', 1)->get();
            foreach ($batches as $key => $batch) :
                $exam = OfflineExam::create([
                    'name' => 'Offline Exam for ' . $batch->name . ' on - ' . Carbon::today()->format('d, M Y'),
                    'batch_id' => $batch->id,
                    'total_mark' => 100,
                    'cut_off_mark' => 40,
                    'question_count' => 100,
                    'duration' => 60,
                    'exam_date' => Carbon::today(),
                    'status' => 1,
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ]);
                $students = StudentBatch::where('batch', $batch->id)->where('cancelled', 0)->get();
                $data = [];
                if ($students) :
                    foreach ($students as $key => $student) :
                        $data[] = [
                            'exam_id' => $exam->id,
                            'student_id' => $student->student,
                            'correct_answer_count' => 0,
                            'wrong_answer_count' => 0,
                            'unattended_count' => 0,
                            'total_mark' => 100,
                            'cutoff_mark' => 40,
                            'total_mark_after_cutoff' => 0,
                            'grade' => 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    endforeach;
                    StudentOfflineExam::insert($data);
                endif;
            endforeach;
        })->dailyAt('1:00');

        $schedule->call(function () {
            $exams = Exam::whereDate('exam_date', Carbon::today())->get();
            foreach ($exams as $key => $exam) :
                $studentexams = StudentExam::where('exam_id', $exam->id)->orderByDesc('total_mark_after_cutoff')->get();
                foreach ($studentexams as $key1 => $sxam) :
                    StudentExam::where('id', $sxam->id)->update(['grade' => $key1 + 1]);
                endforeach;
            endforeach;
        })->dailyAt('23:30');

        $schedule->call(function () {
            $exams = OfflineExam::whereDate('exam_date', Carbon::today())->get();
            foreach ($exams as $key => $exam) :
                $studentexams = StudentOfflineExam::where('exam_id', $exam->id)->orderByDesc('total_mark_after_cutoff')->get();
                foreach ($studentexams as $key1 => $sxam) :
                    StudentOfflineExam::where('id', $sxam->id)->update(['grade' => $key1 + 1]);
                endforeach;
            endforeach;
        })->dailyAt('23:30');

        $schedule->call(function () {
            $closing_balance = $this->getclosingBalance();
            DB::table('daily_closings')->insert(
                ['date' => Carbon::today(), 'closing_balance' => $closing_balance, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );
        })->dailyAt('23:30');

        $schedule->call(function () {
            $etypes = ExamType::where('status', 'Active')->get();
            foreach ($etypes as $key => $item) :
                $exam = Exam::create([
                    'exam_type' => $item->id,
                    'name' => $item->name . ' - ' . Carbon::today()->format('d, M Y'),
                    'batch_id' => $item->batch_id,
                    'cut_off_mark' => $item->cut_off_mark,
                    'question_count' => $item->question_count,
                    'exam_date' => Carbon::now(),
                    'duration' => $item->exam_duration,
                    'status' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $questions = Question::where('status', 1)->where('exam_type', $exam->exam_type)->inRandomOrder()->limit($exam->question_count)->get();
                $data = [];
                foreach ($questions as $key1 => $que) :
                    $data[] = [
                        'exam_id' => $exam->id,
                        'question_id' => $que->id,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                ExamQuestion::insert($data);
            endforeach;
        })->dailyAt('00:30')->appendOutputTo('schedule_log.log');

        $schedule->call(function () {
            $batches = Batch::where('status', 1)->get();
            foreach ($batches as $key => $batch) :
                $students = StudentBatch::where('batch', $batch->id)->where('cancelled', 0)->get();
                $data = [];
                foreach ($students as $key1 => $student) :
                    $data[] = [
                        'student' => $student->student,
                        'batch' => $batch->id,
                        'date' => Carbon::today(),
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                Attendance::insert($data);
            endforeach;
        })->days(range(1, 6))->at('1:00')->appendOutputTo('schedule_log.log'); // Exclude Sunday
    }

    private function getClosingBalance()
    {

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
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
