<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContactType;

class ContactTypeController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::where('clinic_id', session('clinic-id'))
                        ->orderby('name')->get();

        return view('contact-types', [
            'contactTypes' => $contactTypes,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($request->id == "") {
            $contactType = new ContactType;
            $contactType->clinic_id = session('clinic-id');
        } else {
            $contactType = ContactType::find($request->id);
        }

        $contactType->name = $request->name;
        $contactType->save();

        return redirect('/contact-types');
    }

    public function destory(Request $request, ContactType $contactType)
    {
        // TODO add authorization

        $contactType->delete();

        return redirect('/contact-types');
    }
}
