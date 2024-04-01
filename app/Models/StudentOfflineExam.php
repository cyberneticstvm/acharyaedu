<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOfflineExam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(OfflineExam::class, 'exam_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function getPerformance()
    {
        $performance = "";
        $percentage = ($this->total_mark_after_cutoff / $this->total_mark) * 100;
        switch ($percentage):
            case $percentage < 40:
                $performance = "Below Average";
                break;
            case $percentage >= 40 && $percentage < 50:
                $performance = "Average";
                break;
            case $percentage >= 50 && $percentage < 60:
                $performance = "Above Average";
                break;
            case $percentage >= 60 && $percentage < 75:
                $performance = "Good";
                break;
            default:
                $performance = "Excellent";
        endswitch;
        return $performance;
    }
}
