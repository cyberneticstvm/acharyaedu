<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    function getAuthUser(Request $request)
    {
        $user = User::find(1);
        return response()->json([
            'status' => true,
            'user' => $user,
            'header' => $request->header(),
        ], 200);
    }
}
