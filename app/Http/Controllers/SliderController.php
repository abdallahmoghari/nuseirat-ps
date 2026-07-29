<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.slider.index', compact('sliders'));
    }

    public function create()
    {
        return response()->view('cms.slider.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (!$validator->fails()) {
            $sliders = new Slider();

            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/images/slider'), $imageName);
                $sliders->image = $imageName;
            }

            $sliders->title = $request->input('title');
            $sliders->description = $request->input('description');
            $sliders->save();

            session()->flash('success', 'The New Slider Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.show', compact('sliders'));
    }

    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.edit', compact('sliders'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (!$validator->fails()) {
            $sliders = Slider::findOrFail($id);

            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/images/slider'), $imageName);
                $sliders->image = $imageName;
            }

            $sliders->title = $request->input('title');
            $sliders->description = $request->input('description');
            $sliders->save();

            return ['redirect' => route('sliders.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Slider::destroy($id);
    }
}
