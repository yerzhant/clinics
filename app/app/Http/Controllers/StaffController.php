<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use App\Position;
use App\Staff;
use App\User;

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
            'email' => "required|email",
            'password' => 'confirmed',
        ]);

        if ($request->id == "") {
            $staff = new Staff;
            $staff->clinic_id = $this->clinic_id;
            $user_id = 0;
        } else {
            $staff = Staff::find($request->id);
            $user_id = $staff->user_id;
        }

        if (DB::select("select count(*) from security.users where id <> ? and email = ?",
                               [$user_id, $request->email])[0]->count > 0) {
            return back()->withErrors(['E-mail уже используется']);
        }

        $staff->last_name = $request->last_name;
        $staff->first_name = $request->first_name;
        $staff->surname = $request->surname;
        $staff->position_id = $request->position;

        DB::transaction(function() use ($staff, $request) {
            if ($staff->user_id == null) {
                $this->validate($request, [
                    'password' => 'required'
                ]);

                $user = new User;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->save();

                $staff->user_id = $user->id;
            } else {
                $staff->user->email = $request->email;

                if ($request->password != null)
                    $staff->user->password = $request->password;

                $staff->user->save();
            }

            $staff->save();
        });

        return back();
    }

    public function destory(Request $request, Staff $staff)
    {
        // TODO add authorization

        DB::transaction(function() use ($staff) {
            $staff->delete();
            $staff->user()->delete();
        });

        return back();
    }
}
