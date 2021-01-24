<?php

namespace App\Http\Controllers\Auth;

use Auth, Hash;
use App\User;
use App\Http\Requests\RegisterReq;
use App\Http\Controllers\Controller;
use http\Cookie;
use Illuminate\Http\{Request, Response};

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('admin')->accessToken;
            $cookie = cookie('jwt', $token, 3600);
            return response([
                'token' => $token
            ])->withCookie($cookie);
        }
        return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        $cookie = \Cookie::forget('jwt');
        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function register(RegisterReq $request)
    {
        $user = User::create($request->only('first_name','last_name','email','role_id') +
            ['password' => Hash::make($request->input('password'))]);
        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }
}
