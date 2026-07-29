<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('permissions')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.spaity.roles', compact('roles'));
    }

    public function create()
    {
        return response()->view('cms.spaity.create-role');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
        ]);

        if (!$validator->fails()) {
            $role = Role::create([
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name'),
            ]);

            session()->flash('success', 'The New Role Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $roles = Role::withCount('permissions')->findOrFail($id);
        return response()->view('cms.spaity.edit-role', compact('roles'));
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        return response()->view('cms.spaity.edit-role', compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
            'guard_name' => 'required',
        ]);

        if (!$validator->fails()) {
            $role = Role::findOrFail($id);
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard_name');
            $role->save();

            return ['redirect' => route('roles.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Role::destroy($id);
    }
}
