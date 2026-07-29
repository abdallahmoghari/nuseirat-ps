<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.author.index', compact('authors'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::where('guard_name', 'author')->get();
        return response()->view('cms.author.create', compact('cities', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:authors,email',
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $authors = new Author();
        $authors->email = $request->get('email');
        $authors->password = Hash::make($request->get('password'));
        $authors->save();

        $users = new User();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/author'), $imageName);
            $users->image = $imageName;
        }

        $role = Role::findOrFail($request->get('role_id'));
        $authors->assignRole($role->name);

        $users->first_name = $request->get('first_name');
        $users->last_name = $request->get('last_name');
        $users->mobile = $request->get('mobile');
        $users->date = $request->get('date');
        $users->gender = $request->get('gender');
        $users->status = $request->get('status');
        $users->city_id = $request->get('city_id');
        $users->actor()->associate($authors);
        $users->save();

        return response()->json([
            'icon' => 'success',
            'title' => 'Created Author is Successfully',
        ], 200);
    }

    public function show($id)
    {
        $authors = Author::find($id);
        return response()->view('cms.author.show', compact('authors'));
    }

    public function edit($id)
    {
        $cities = City::all();
        $authors = Author::findOrFail($id);
        return response()->view('cms.author.edit', compact('cities', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:authors,email,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $authors = Author::findOrFail($id);
        $authors->email = $request->get('email');
        $authors->save();

        $users = $authors->user;

        if ($request->hasFile('image')) {
            if ($users->image) {
                $oldPath = public_path('storage/images/author/' . $users->image);
                if (file_exists($oldPath)) @unlink($oldPath);
            }
            $image = $request->file('image');
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/author'), $imageName);
            $users->image = $imageName;
        }

        $users->first_name = $request->get('first_name');
        $users->last_name = $request->get('last_name');
        $users->mobile = $request->get('mobile');
        $users->date = $request->get('date');
        $users->gender = $request->get('gender');
        $users->status = $request->get('status');
        $users->city_id = $request->get('city_id');
        $users->actor()->associate($authors);
        $users->save();

        return ['redirect' => route('authors.index')];
    }

    public function destroy($id)
    {
        Author::destroy($id);
    }
}
