<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::take(3)->get();
        $articles = Article::orderBy('created_at', 'desc')->take(12)->get();
        $deptNames = ['التقارير المالية','الأنظمة والقوانين','تقارير إدارية','الخطة التشغيلية','قرارات المجلس البلدي'];
        $categories = Category::where('status', 'active')->whereNotIn('name', $deptNames)->withCount('articles')->get();
        $recent = Article::orderBy('created_at', 'desc')->take(4)->get();
        return response()->view('news.index', compact('categories', 'sliders', 'articles', 'recent'));
    }

    public function allNews($slug)
    {
        $category = Category::withCount('articles')->findBySlug($slug)->firstOrFail();
        $articles = Article::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(6);
        return response()->view('news.all-news', compact('category', 'articles'));
    }

    public function detailes($slug)
    {
        $articles = Article::findBySlug($slug)->firstOrFail();
        return response()->view('news.newsdetailes', compact('articles'));
    }

    public function showContact()
    {
        return response()->view('news.contact');
    }

    public function storeContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if (!$validator->fails()) {
            $contacts = new Contact();
            $contacts->name = $request->input('name');
            $contacts->phone = $request->input('phone');
            $contacts->email = $request->input('email');
            $contacts->message = $request->input('message');
            $contacts->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إرسال الرسالة بنجاح',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function about()
    {
        return response()->view('news.about');
    }

    public function services()
    {
        return response()->view('news.services');
    }
}
