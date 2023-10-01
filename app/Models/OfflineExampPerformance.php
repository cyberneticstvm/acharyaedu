<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfflineExampPerformance extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = ['exam_date' => 'datetime'];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function getPerformance(){
        $performance = ""; $percentage = $this->performance;
        switch($percentage):
            case $percentage < 40:
                $performance = "Below Average";
                break;
            case $percentage >= 40 && $percentage < 50:
                $performance = "Average";
                break;
            case $percentage >= 50 && $percentage < 60:
                $performance = "Above Average";
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
