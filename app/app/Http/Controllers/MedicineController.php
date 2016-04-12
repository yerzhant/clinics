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
        ]);

        if ($request->id == "") {
            $Medicine = new Medicine;
            $Medicine->clinic_id = session('clinic-id');
        } else {
            $Medicine = Medicine::find($request->id);
        }

        $Medicine->name = $request->name;
        $Medicine->price = $request->price ?: null;
        $Medicine->save();

        return redirect('/medicines');
    }

    public function destory(Request $request, Medicine $medicine)
    {
        // TODO add authorization

        $medicine->delete();

        return redirect('/medicines');
    }
}
