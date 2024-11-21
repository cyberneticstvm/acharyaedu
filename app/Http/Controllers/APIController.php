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
        if ($request->header()['authorization'] == $this->token) {
            $user = User::find(1);
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'success',
                'token' => $request->header()['authorization'],
                'mobile' => $this->token,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'user' => null,
                'message' => 'failed',
                'token' => $request->header()['authorization'],
                'mobile' => $this->token,
            ], 400);
        }
    }
}
