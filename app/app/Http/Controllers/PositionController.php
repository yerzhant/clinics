<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::where('clinic_id', $this->clinic_id)
                        ->orderby('name')->get();

        return view('positions', [
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'name' => 'required|unique:positions,name,null,id,clinic_id,' . $this->clinic_id,
            'admin' => 'required_without_all:doctor,accountant,receptionist',
            'doctor' => 'required_without_all:admin,accountant,receptionist',
            'accountant' => 'required_without_all:admin,doctor,receptionist',
            'receptionist' => 'required_without_all:admin,doctor,accountant',
        ]);

        if ($request->id == "") {
            $position = new Position;
            $position->clinic_id = $this->clinic_id;
        } else {
            $position = Position::find($request->id);
        }

        $position->name = $request->name;

        $roles = [];

        if($request->admin == "on")
            $roles[] = "admin";

        if($request->doctor == "on")
            $roles[] = "doctor";

        if($request->accountant == "on")
            $roles[] = "accountant";

        if($request->receptionist == "on")
            $roles[] = "receptionist";

        $position->roles = "{" . implode(",", $roles) . "}";

        $position->save();

        return redirect('/positions');
    }

    public function destory(Request $request, Position $position)
    {
        // TODO add authorization

        $position->delete();

        return redirect('/positions');
    }
}
