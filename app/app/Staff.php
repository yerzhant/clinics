<?php

namespace App;

class Staff extends Model
{
    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function workTimes()
    {
        return $this->hasMany('App\WorkTime');
    }
}
