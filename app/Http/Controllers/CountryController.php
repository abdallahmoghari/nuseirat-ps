<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.country.index', compact('countries'));
    }

    public function create()
    {
        return response()->view('cms.country.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required',
            'code' => 'required',
        ]);

        if (!$validator->fails()) {
            $countries = new Country();
            $countries->country_name = $request->input('country_name');
            $countries->code = $request->input('code');
            $countries->save();

            session()->flash('success', 'The New Country Is Added Successfly !');
            return redirect()->back();
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $countries = Country::with('cities')->findOrFail($id);
        return response()->view('cms.country.show', compact('countries'));
    }

    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        return response()->view('cms.country.edit', compact('countries'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required',
            'code' => 'required',
        ]);

        if (!$validator->fails()) {
            $countries = Country::findOrFail($id);
            $countries->country_name = $request->input('country_name');
            $countries->code = $request->input('code');
            $countries->save();

            return ['redirect' => route('countries.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        Country::destroy($id);
    }

    public function indexTrashed()
    {
        $countries = Country::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.country.trashed', compact('countries'));
    }

    public function restore($id)
    {
        Country::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        Country::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }

    public function forceDeleteAll()
    {
        Country::onlyTrashed()->forceDelete();
        return redirect()->back();
    }

}
