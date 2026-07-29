<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $currentAdmin = Auth::user();
        $admins = Admin::where('id', '!=', $currentAdmin->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->view('cms.admin.index', compact('admins'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('cms.admin.create', compact('cities', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:admins,email',
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $admins = new Admin();
        $admins->email = $request->get('email');
        $admins->password = Hash::make($request->get('password'));
        $admins->save();

        $users = new User();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/admin'), $imageName);
            $users->image = $imageName;
        }

        $role = Role::findOrFail($request->get('role_id'));
        $admins->assignRole($role->name);

        $users->first_name = $request->get('first_name');
        $users->last_name = $request->get('last_name');
        $users->mobile = $request->get('mobile');
        $users->date = $request->get('date');
        $users->gender = $request->get('gender');
        $users->status = $request->get('status');
        $users->city_id = $request->get('city_id');
        $users->actor()->associate($admins);
        $users->save();

        return response()->json([
            'icon' => 'success',
            'title' => 'Created Admin is Successfully',
        ], 200);
    }

    public function show($id)
    {
        $admins = Admin::find($id);
        return response()->view('cms.admin.show', compact('admins'));
    }

    public function edit($id)
    {
        $cities = City::all();
        $admins = Admin::findOrFail($id);
        return response()->view('cms.admin.edit', compact('cities', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:admins,email,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $admins = Admin::findOrFail($id);
        $admins->email = $request->get('email');
        $admins->save();

        $users = $admins->user;

        if ($request->hasFile('image')) {
            if ($users->image) {
                $oldPath = public_path('storage/images/admin/' . $users->image);
                if (file_exists($oldPath)) @unlink($oldPath);
            }
            $image = $request->file('image');
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/admin'), $imageName);
            $users->image = $imageName;
        }

        $users->first_name = $request->get('first_name');
        $users->last_name = $request->get('last_name');
        $users->mobile = $request->get('mobile');
        $users->date = $request->get('date');
        $users->gender = $request->get('gender');
        $users->status = $request->get('status');
        $users->city_id = $request->get('city_id');
        $users->actor()->associate($admins);
        $users->save();

        return ['redirect' => route('admins.index')];
    }

    public function destroy($id)
    {
        Admin::destroy($id);
    }
}
