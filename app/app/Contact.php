<?php

namespace App;

class Contact extends Model
{
    public function contactType()
    {
        return $this->belongsTo('App\ContactType');
    }
}
