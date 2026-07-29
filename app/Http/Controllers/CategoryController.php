<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.category.index', compact('categories'));
    }

    public function create()
    {
        return response()->view('cms.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $categories = new Category();
            $categories->name = $request->input('name');
            $categories->status = $request->input('status');
            $categories->description = $request->input('description');
            $categories->save();

            session()->flash('success', 'The New Category Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $categories = Category::findOrFail($id);
            $categories->name = $request->input('name');
            $categories->status = $request->input('status');
            $categories->description = $request->input('description');
            $categories->save();

            return ['redirect' => route('categories.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Category::destroy($id);
    }
}
