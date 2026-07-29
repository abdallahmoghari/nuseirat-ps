<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contacts = Contact::findOrFail($id);
        return response()->view('cms.contact.show', compact('contacts'));
    }

    public function destroy($id)
    {
        Contact::destroy($id);
    }
}
