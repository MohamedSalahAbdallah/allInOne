<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        // $guardes =['employee' , 'user'];
        if (Auth::guard('employee')->attempt($credentials)) {

            $user = Auth::guard('employee')->user();
            $token = $user->createToken('Access Token')->accessToken;

            return response()->json(['token' => $token,'user'=>$user], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
