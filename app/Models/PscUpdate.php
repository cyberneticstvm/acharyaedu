<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PscUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pmonth',
        'pyear',
        'attachment',
        'description',
        'created_by',
        'updated_by',
    ];
}
