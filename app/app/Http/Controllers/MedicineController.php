<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::where('clinic_id', session('clinic-id'))
                        ->orderby('name')->get();

        return view('medicines', [
            'medicines' => $medicines,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'name' => 'required',
            'price' => 'numeric',
        ]);

        if ($request->id == "") {
            $medicine = new Medicine;
            $medicine->clinic_id = session('clinic-id');
        } else {
            $medicine = Medicine::find($request->id);
        }

        $medicine->name = $request->name;
        $medicine->price = $request->price ?: null;
        $medicine->save();

        return redirect('/medicines');
    }

    public function destory(Request $request, Medicine $medicine)
    {
        // TODO add authorization

        $medicine->delete();

        return redirect('/medicines');
    }
}
