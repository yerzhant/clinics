<?php

namespace App;

class ContactType extends Model
{
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
