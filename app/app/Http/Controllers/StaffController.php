<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;
use App\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $positions = Position::where('clinic_id', $this->clinic_id)
                        ->orderby('name')->get();

        $staff = Staff::where('clinic_id', $this->clinic_id)
                        ->orderby('last_name')->get();

        return view('staff', [
            'positions' => $positions,
            'staff' => $staff,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'position' => 'required|exists:positions,id,clinic_id,' . $this->clinic_id,
        ]);

        if ($request->id == "") {
            $staff = new Staff;
            $staff->clinic_id = $this->clinic_id;
            $staff->user_id = $this->user_id;
        } else {
            $staff = Staff::find($request->id);
        }

        $staff->last_name = $request->last_name;
        $staff->first_name = $request->first_name;
        $staff->surname = $request->surname;
        $staff->position_id = $request->position;

        $staff->save();

        return back();
    }

    public function destory(Request $request, Staff $staff)
    {
        // TODO add authorization

        $staff->delete();

        return back();
    }
}
