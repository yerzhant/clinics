<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContactType;

class ContactTypeController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::where([
            ['clinic_id', $this->clinic_id],
            ['is_billing', false],
        ])->orderby('name')->get();

        return view('contact-types', [
            'contactTypes' => $contactTypes,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        if ($request->id == "") {
            $contactType = new ContactType;
            $contactType->clinic_id = $this->clinic_id;
            $contactTypeId = 'null';
        } else {
            $contactType = ContactType::find($request->id);
            $contactTypeId = $contactType->id;
        }

        $this->validate($request, [
            'name' => 'required|unique:contact_types,name,' . $contactTypeId .
                      ',id,is_billing,false,clinic_id,' . $this->clinic_id,
        ]);

        $contactType->name = $request->name;
        $contactType->save();

        return back();
    }

    public function destory(Request $request, ContactType $contactType)
    {
        // TODO add authorization

        $contactType->delete();

        return back();
    }
}
