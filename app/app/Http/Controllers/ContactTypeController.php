<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContactType;

class ContactTypeController extends Controller
{
    public function index()
    {
        return view('contact-types.index');
    }

    public function store(Request $reqest)
    {
        $ct = new ContactType;
        $ct->name = $reqest->name;
        $ct->clinic_id = session('clinic-id');
        $ct->save();

        return redirect('/contact-types');
    }

    public function destory(Request $request, ContactType $contactType)
    {

    }
}
