<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleCompleteStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch',
        'module',
        'faculty',
        'status',
        'created_by',
        'updated_by',
    ];

    public function modules(){
        return $this->belongsTo(Topic::class, 'module', 'id');
    }
}
