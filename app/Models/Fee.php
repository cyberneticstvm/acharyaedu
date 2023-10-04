<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'batch',
        'paid_date',
        'fee_month',
        'fee_year',
        'fee', 
        'fee_advance',
        'fee_balance',
        'payment_mode',
        'tentative_date',
        'remarks',
        'discount_applicable',
        'fee_pending',
        'created_by',
        'updated_by',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student');
    }

    public function batches(){
        return $this->belongsTo(Batch::class, 'batch');
    }

    public function mname(){
        return $this->belongsTo(Month::class, 'fee_month');
    }

    public function feemonth(){
        return $this->belongsTo(Month::class, 'fee_month', 'id');
    }

    public function feeyear(){
        return $this->belongsTo(Year::class, 'fee_year', 'id');
    }

    protected $casts = ['paid_date' => 'date', 'tentative_date' => 'date'];
}
