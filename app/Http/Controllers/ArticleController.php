<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function indexArticle($id)
    {
        $authors = Author::findOrFail($id);
        $articles = Article::where('author_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('cms.article.index', compact('articles', 'id', 'authors'));
    }

    public function createArticle($id)
    {
        $categories = Category::where('status', 'active')->get();
        $authors = Author::all();
        return response()->view('cms.article.create', compact('categories', 'authors', 'id'));
    }

    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.article.indexAll', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $authors = Author::all();
        return response()->view('cms.article.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (!$validator->fails()) {
            $articles = new Article();

            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/images/article'), $imageName);
                $articles->image = $imageName;
            }

            $articles->title = $request->input('title');
            $articles->short_description = $request->input('short_description');
            $articles->full_description = $request->input('full_description');
            $articles->category_id = $request->input('category_id');
            $articles->author_id = $request->input('author_id');

            $isSaved = $articles->save();
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is Successfully',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function show($id)
    {
        $articles = Article::find($id);
        return response()->view('cms.article.show', compact('articles'));
    }

    public function edit($id)
    {
        $categories = Category::where('status', 'active')->get();
        $authors = Author::all();
        $articles = Article::findOrFail($id);
        return response()->view('cms.article.edit', compact('categories', 'authors', 'articles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (!$validator->fails()) {
            $articles = Article::findOrFail($id);

            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/images/article'), $imageName);
                $articles->image = $imageName;
            }

            $articles->title = $request->input('title');
            $articles->short_description = $request->input('short_description');
            $articles->full_description = $request->input('full_description');
            $articles->category_id = $request->input('category_id');
            $articles->author_id = $request->input('author_id');

            $articles->save();

            return ['redirect' => route('articles.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Article::destroy($id);
    }
}
