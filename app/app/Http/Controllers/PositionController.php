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

        if ($request->id == "") {
            $position = new Position;
            $position->clinic_id = $this->clinic_id;
            $positionId = 'null';
        } else {
            $position = Position::find($request->id);
            $positionId = $position->id;
        }

        $this->validate($request, [
            'name' => 'required|unique:positions,name,' . $positionId .
                      ',id,clinic_id,' . $this->clinic_id,
            'admin' => 'required_without_all:doctor,accountant,receptionist',
            'doctor' => 'required_without_all:admin,accountant,receptionist',
            'accountant' => 'required_without_all:admin,doctor,receptionist',
            'receptionist' => 'required_without_all:admin,doctor,accountant',
        ]);

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

        return back();
    }

    public function destory(Request $request, Position $position)
    {
        // TODO add authorization

        $position->delete();

        return back();
    }
}
