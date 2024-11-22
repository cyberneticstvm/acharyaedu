<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = null;
        if ($headers['authorization'] == $this->token) {
            $credentials = array('email' => $request->email, 'password' => $request->password, 'status' => 'active');
            if (Auth::attempt($credentials)):
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
            endif;
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
                    'email' => $request->getContent()['email'],
                ], 404);
            endif;
        } else {
            return response()->json([
                'status' => false,
                'user' => $user,
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
