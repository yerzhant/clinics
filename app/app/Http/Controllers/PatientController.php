<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('clinic_id', session('clinic-id'))
                        ->orderby('last_name')->get();

        return view('patients', [
            'patients' => $patients,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'birth_date' => 'date',
        ]);

        if ($request->id == "") {
            $patient = new Patient;
            $patient->clinic_id = session('clinic-id');
        } else {
            $patient = Patient::find($request->id);
        }

        $patient->last_name = $request->last_name;
        $patient->first_name = $request->first_name;
        $patient->surname = $request->surname;
        $patient->birth_date = $request->birth_date;
        $patient->doc_type = $request->doc_type;
        $patient->doc_number = $request->doc_number;
        
        $patient->save();

        return redirect('/patients');
    }

    public function destory(Request $request, Medicine $medicine)
    {
        // TODO add authorization

        $medicine->delete();

        return redirect('/medicines');
    }
}
