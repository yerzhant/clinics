<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Staff;
use App\Visit;

class VisitController extends Controller
{
    public function index(Staff $staff)
    {
        return view('visits', [
            'staff' => $staff,
            'visits' => $staff->visits()->orderby('assigned_on')->get(),
        ]);
    }

    public function store(Request $request, Staff $staff)
    {
        // TODO to be added an authorization

        if ($request->id == "") {
            $service = new Service;
            $service->staff_id = $staff->id;
            $service_id = 0;
        } else {
            $service = Service::find($request->id);
            $service_id = $service->id;
        }

        $this->validate($request, [
            'name' => 'required|unique:services,name,' . $service_id . ',id,staff_id,' . $staff->id,
            'price' => 'numeric',
        ]);

        $service->name = $request->name;
        $service->price = $request->price ?: null;
        $service->save();

        return back();
    }

    public function destory(Request $request, Service $service)
    {
        // TODO add authorization

        $service->delete();

        return back();
    }
}
