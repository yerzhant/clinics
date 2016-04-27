<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('clinic_id', $this->clinic_id)
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
            'doc_type' => 'required_with:doc_number',
        ]);

        $this->validate($request, [
            'doc_number' => 'unique:patients,doc_number,null,id,' .
                          'doc_type,' . $request->doc_type . ',' .
                          'clinic_id,' . $this->clinic_id,
        ]);

        if ($request->id == "") {
            $patient = new Patient;
            $patient->clinic_id = $this->clinic_id;
        } else {
            $patient = Patient::find($request->id);
        }

        $patient->last_name = $request->last_name;
        $patient->first_name = $request->first_name;
        $patient->surname = $request->surname;
        $patient->birth_date = $request->birth_date;
        $patient->doc_type = $request->doc_number === "" ? null : $request->doc_type;
        $patient->doc_number = $request->doc_number;

        $patient->save();

        return back();
    }

    public function destory(Request $request, Patient $patient)
    {
        // TODO add authorization

        $patient->delete();

        return back();
    }
}
