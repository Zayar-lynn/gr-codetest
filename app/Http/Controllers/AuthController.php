<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('token')->plainTextToken;
            if(isset($token)){
                return response()->json([
                    'status' => 'success',
                    'data' => $token
                ]);
            }
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
        // Cookie::forget('token');
        Auth::logout();
        return redirect('/');
    }
}
