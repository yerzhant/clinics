<?php

namespace App;

class WorkTime extends Model
{
    public function getDayStringAttribute()
    {
        switch ($this->day) {
            case 1:
                $day = "Пн";
                break;

            case 2:
                $day = "Вт";
                break;

            case 3:
                $day = "Ср";
                break;

            case 4:
                $day = "Чт";
                break;

            case 5:
                $day = "Пт";
                break;

            case 6:
                $day = "Сб";
                break;

            case 7:
                $day = "Вс";
                break;
        }

        return $day;
    }

    public function getFromTimeAttribute($value)
    {
        return substr($value, 0, 5);
    }

    public function getToTimeAttribute($value)
    {
        return substr($value, 0, 5);
    }
}
