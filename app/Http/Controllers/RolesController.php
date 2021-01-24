<?php

namespace App\Http\Controllers;

use App\Role;
use Gate;
use App\Http\Resources\RoleResource;
use Illuminate\Http\{Request, Response};

class RolesController extends Controller
{

    public function index()
    {
        Gate::authorize('view', 'roles');
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', 'roles');
        $role = Role::create($request->only('name'));

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                \DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id
                ]);
            }
        }

        return response()->json(['role' => new RoleResource($role)], Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        Gate::authorize('view', 'roles');
        return new RoleResource($role);
    }


    public function edit(Role $role)
    {
        return new RoleResource($role);
    }


    public function update(Request $request, Role $role)
    {
        Gate::authorize('edit', 'roles');
        $role->update($request->only('name'));

        \DB::table('role_permissions')->where('role_id', $role->id)->delete();

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                \DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id
                ]);
            }
        }
        return response()->json(['role' => new RoleResource($role)], Response::HTTP_ACCEPTED);
    }

    public function destroy(Role $role)
    {
        Gate::authorize('edit', 'roles');
        \DB::table('role_permissions')->where('role_id', $role->id)->delete();
        if ($role->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
    }
}
