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
}
