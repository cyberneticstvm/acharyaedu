<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function module($sid){
        $data = Topic::where('subject_id', $sid)->select('id', 'name')->get();
        return response()->json($data);
    }
}
