<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.city.index', compact('cities'));
    }

    public function create()
    {
        $countries = \App\Models\Country::all();
        return response()->view('cms.city.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'country_id' => 'required',
        ]);

        if (!$validator->fails()) {
            $cities = new City();
            $cities->name = $request->input('name');
            $cities->street = $request->input('street');
            $cities->country_id = $request->input('country_id');
            $cities->save();

            session()->flash('success', 'The New City Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $cities = City::findOrFail($id);
        return response()->view('cms.city.edit', compact('cities'))->with('countries', \App\Models\Country::all());
    }

    public function edit($id)
    {
        $countries = \App\Models\Country::all();
        $cities = City::findOrFail($id);
        return response()->view('cms.city.edit', compact('countries', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'country_id' => 'required',
        ]);

        if (!$validator->fails()) {
            $cities = City::findOrFail($id);
            $cities->name = $request->input('name');
            $cities->street = $request->input('street');
            $cities->country_id = $request->input('country_id');
            $cities->save();

            return ['redirect' => route('cities.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        City::destroy($id);
    }
}
