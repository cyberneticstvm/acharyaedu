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
        $headers = $this->getHeader($request);
        if ($headers['authorization'] == $this->token) {
            $user = User::find(1);
            if ($user):
                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'message' => 'success',
                ], 200);
            else:
                return response()->json([
                    'status' => false,
                    'user' => $user,
                    'message' => 'Invalid Credentials',
                ], 404);
            endif;
        } else {
            return response()->json([
                'status' => false,
                'user' => null,
                'message' => 'Invalid Authentication Token',
            ], 500);
        }
    }

    function getHeader($request)
    {
        $headers = collect($request->header())->transform(function ($item) {
            return $item[0];
        });
        return $headers;
    }
}
