<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'revision_id',
        'module_id',
    ];

    public function module(){
        return $this->belongsTo(Topic::class, 'id', 'module_id');
    }
}
