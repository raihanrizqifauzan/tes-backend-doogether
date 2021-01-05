<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'invalid_credentials']);
        }
        $user = DB::table('user')
                ->where('email', '=', $request->email)
                ->get();
        $result = [
            'user' => $user,
            'token' => $token
        ];

        return $result;
    }
}
