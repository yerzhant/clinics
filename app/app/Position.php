<?php

namespace App;

class Position extends Model
{
    public function getRolesAsStringAttribute($value)
    {
        $roles = substr($this->roles, 1, -1);
        $roles = str_replace('admin', 'Администратор', $roles);
        $roles = str_replace('doctor', 'Врач', $roles);
        $roles = str_replace('accountant', 'Бухгалтер', $roles);
        $roles = str_replace('receptionist', 'Рисепшнист', $roles);
        $roles = str_replace(',', ', ', $roles);

        return $roles;
    }

    public function getIsAdminAttribute($value)
    {
        return strpos($this->roles, "admin") !== false ? "true" : "false";
    }

    public function getIsDoctorAttribute($value)
    {
        return strpos($this->roles, "doctor") !== false ? "true" : "false";
    }

    public function getIsAccountantAttribute($value)
    {
        return strpos($this->roles, "accountant") !== false ? "true" : "false";
    }

    public function getIsReceptionistAttribute($value)
    {
        return strpos($this->roles, "receptionist") !== false ? "true" : "false";
    }
}
