<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContactType;
use App\Contact;
use App\Patient;

class ContactController extends Controller
{
    public function index(Patient $patient)
    {
        if (!session()->has('prev-path')) {
            session()->flash('prev-path', url()->previous());
        } else {
            session()->keep('prev-path');
        }

        // TODO add an authorization so that not to allow to get an alien patient

        $contactTypes = ContactType::where([
            ['clinic_id', $this->clinic_id],
            ['is_billing', false],
        ])->orderby('name')->get();

        return view('contacts', [
            'patient' => $patient,
            'contactTypes' => $contactTypes,
            'contacts' => $patient->contacts()->orderby('contact_type_id', 'value')->get(),
        ]);
    }

    public function store(Patient $patient, Request $request)
    {
        session()->keep('prev-path');

        // TODO to be added an authorization

        $this->validate($request, [
            'contactType' => 'required|exists:contact_types,id,is_billing,false,clinic_id,' . $this->clinic_id,
            'value' => 'required',
        ]);

        if ($request->id == "") {
            $contact = new Contact;
            $contact->patient_id = $patient->id;
        } else {
            $contact = Contact::find($request->id);
        }

        $contact->contact_type_id = $request->contactType;
        $contact->value = $request->value;
        $contact->save();

        return back();
    }

    public function destory(Request $request, Patient $patient, Contact $contact)
    {
        session()->keep('prev-path');

        // TODO add authorization

        $contact->delete();

        return back();
    }
}
