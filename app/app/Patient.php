<?php

namespace App;

class Patient extends Model
{
    protected $dates = ["birth_date"];

    protected $dateFormat = "d.m.Y";

    public function getBirthDateAttribute($value)
    {
        return date($this->dateFormat, strtotime($value));
    }

    public function getDocTypeAttribute($value)
    {
        switch ($value) {
            case 'id':
                return "Уд/л";

            case 'passport':
                return "Паспорт";
        };
    }
}
