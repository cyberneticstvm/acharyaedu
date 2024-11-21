<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    private $token;
    function __construct()
    {
        $this->token = '+919497273727';
    }
    function getAuthUser(Request $request)
    {
        $headers = collect($request->header())->transform(function ($item) {
            return $item[0];
        });
        if ($request->header()['authorization'] == $this->token) {
            $user = User::find(1);
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'success',
                'token' => $headers,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'user' => null,
                'message' => 'failed',
                'token' => $headers,
            ], 400);
        }
    }
}
