<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.spaity.permissions', compact('permissions'));
    }

    public function create()
    {
        return response()->view('cms.spaity.create-permission');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required',
        ]);

        if (!$validator->fails()) {
            Permission::create([
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name'),
            ]);

            session()->flash('success', 'The New Permission Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $permissions = Permission::findOrFail($id);
        return response()->view('cms.spaity.edit-permission', compact('permissions'));
    }

    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);
        return response()->view('cms.spaity.edit-permission', compact('permissions'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id,
            'guard_name' => 'required',
        ]);

        if (!$validator->fails()) {
            $permission = Permission::findOrFail($id);
            $permission->name = $request->input('name');
            $permission->guard_name = $request->input('guard_name');
            $permission->save();

            return ['redirect' => route('permissions.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Permission::destroy($id);
    }
}
