<?php

namespace App\Http\Controllers;

use Hash;
use App\Http\Requests\{UserCreateReq, UserUpdateReq};
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::paginate(2);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UserCreateReq $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }

    public function update(UserUpdateReq $request, User $user)
    {
        if ($user) {
            $user->update($request->only('first_name','last_name','email'));
            return response()->json(['user' => $user], Response::HTTP_ACCEPTED);
        }
        return response()->json(['err' => 'User not found'], Response::HTTP_BAD_REQUEST);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
