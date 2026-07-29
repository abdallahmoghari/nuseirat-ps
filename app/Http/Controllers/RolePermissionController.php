<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        $permissions = Permission::where('guard_name', $role->guard_name)->paginate(10);
        return response()->view('cms.spaity.role-permission', compact('role', 'permissions'));
    }

    public function store(Request $request, Role $role)
    {
        $permission = Permission::findOrFail($request->get('permission_id'));

        if ($role->hasPermissionTo($permission->name)) {
            $role->revokePermissionTo($permission->name);
        } else {
            $role->givePermissionTo($permission->name);
        }

        return redirect()->back();
    }
}
