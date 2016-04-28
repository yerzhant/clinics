<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Staff;
use App\WorkTime;

class WorkTimeController extends Controller
{
    public function index(Staff $staff)
    {
        return view('work-times', [
            'staff' => $staff,
            'workTimes' => $staff->workTimes()->orderby('day')->orderby('from_time')->get(),
        ]);
    }

    public function store(Request $request, Staff $staff)
    {
        // TODO to be added an authorization

        $this->validate($request, [
            'day' => 'required|integer|between:1,7',
            'from_time' => 'date_format:H:i|required_with:to_time',
            'to_time' => 'date_format:H:i|required_with:from_time',
        ]);

        if ($request->from_time != null && strtotime($request->from_time) >= strtotime($request->to_time)) {
            return back()->withErrors(['Время С должно быть меньше чем До']);
        }

        if ($request->id == "") {
            $workTime = new WorkTime;
            $workTime->staff_id = $staff->id;
        } else {
            $workTime = WorkTime::find($request->id);
        }

        $workTime->day = $request->day;
        $workTime->from_time = $request->from_time ?: null;
        $workTime->to_time = $request->to_time ?: null;

        $workTime->save();

        return back();
    }

    public function destory(Request $request, WorkTime $workTime)
    {
        // TODO add authorization

        $workTime->delete();

        return back();
    }
}
