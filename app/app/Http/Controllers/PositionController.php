<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::where('clinic_id', session('clinic-id'))
                        ->orderby('name')->get();

        return view('positions', [
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
        ]);

        if ($request->id == "") {
            $position = new Position;
            $position->clinic_id = session('clinic-id');
        } else {
            $position = Position::find($request->id);
        }

        $position->name = $request->name;
        // $position->price = $request->price ?: null;
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
