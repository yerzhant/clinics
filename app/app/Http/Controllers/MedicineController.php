<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::where('clinic_id', $this->clinic_id)
                        ->orderby('name')->get();

        return view('medicines', [
            'medicines' => $medicines,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        if ($request->id == "") {
            $medicine = new Medicine;
            $medicine->clinic_id = $this->clinic_id;
            $medicineId = 'null';
        } else {
            $medicine = Medicine::find($request->id);
            $medicineId = $medicine->id;
        }

        $this->validate($request, [
            'name' => 'required|unique:medicines,name,' . $medicineId .
                      ',id,clinic_id,' . $this->clinic_id,
            'price' => 'numeric',
        ]);

        $medicine->name = $request->name;
        $medicine->price = $request->price ?: null;
        $medicine->save();

        return back();
    }

    public function destory(Request $request, Medicine $medicine)
    {
        // TODO add authorization

        $medicine->delete();

        return back();
    }
}
