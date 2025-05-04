<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string'
        ]);
        $identifier = $request->input('identifier');
        $password = $request->input('password');

        $filsedType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if(Auth::attempt([$filsedType => $identifier, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);
        }

        return response()->json(['message' => 'Login unsuccessful'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out']);
    }
}
