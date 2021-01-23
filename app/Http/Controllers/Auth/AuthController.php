<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, Response};

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return ['token' => $user->createToken('admin')->accessToken];
        }
        return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }
}
