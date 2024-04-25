<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'mobile_alt',
        'dob',
        'qualification',
        'category',
        'address',
        'admission_date',
        'fee',
        'admission_fee_advance',
        'admission_fee_balance',
        'payment_mode',
        'tentative_date',
        'balance_received',
        'remarks',
        'discount_applicable',
        'photo',
        'course_id',
        'branch',
        'type',
        'created_by',
        'updated_by',
    ];

    protected $casts = ['tentative_date' => 'date', 'admission_date' => 'date'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function batches()
    {
        return $this->hasMany(StudentBatch::class, 'student');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student');
    }

    public function batchFee()
    {
        return $this->hasMany(Fee::class, 'student');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
