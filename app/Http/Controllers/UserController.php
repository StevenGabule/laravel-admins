<?php

namespace App\Http\Controllers;

use Auth, Hash, Gate;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\{UserCreateReq, UserUpdateReq};
use App\Http\Resources\UserResource;
use Illuminate\Http\{Request, Resources\Json\AnonymousResourceCollection, Response};

class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index()
    {
        Gate::authorize('view', 'users');
        $users = User::paginate(5);
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        Gate::authorize('view', 'users');
        return new UserResource($user);
    }

    public function store(UserCreateReq $request)
    {
        Gate::authorize('edit', 'users');
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response()->json(['user' => new UserResource($user)], Response::HTTP_CREATED);
    }

    public function update(UserUpdateReq $request, User $user)
    {
        Gate::authorize('edit', 'users');

        if ($user) {
            $user->update($request->only('first_name', 'last_name', 'email'));
            return response()->json(['user' => new UserResource($user)], Response::HTTP_ACCEPTED);
        }
        return response()->json(['err' => 'User not found'], Response::HTTP_BAD_REQUEST);
    }

    public function destroy(User $user)
    {
        Gate::authorize('edit', 'users');
        if ($user->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json(null, Response::HTTP_BAD_REQUEST);
    }

    public function profile()
    {
        $user = Auth::user();
        return (new UserResource($user))->additional([
            'data' => [
                'permissions' => $user->permissions()
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name', 'email'));
        return response()->json(['user' => new UserResource($user)], Response::HTTP_ACCEPTED);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $user->update(['password' => Hash::make($request->input('password'))]);
        return response()->json(['user' => new UserResource($user)], Response::HTTP_ACCEPTED);
    }
}
